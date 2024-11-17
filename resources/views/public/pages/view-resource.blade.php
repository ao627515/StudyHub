@extends('public.layouts.app')

@section('styles')
    <style>
        .pdf-container {
            max-width: 100%;
            margin: 20px auto;
            padding: 15px;
        }

        .pdf-controls {
            margin-bottom: 20px;
        }

        #the-canvas {
            max-width: 100%;
            height: auto !important;
            /* Force le respect de la hauteur proportionnelle */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        /* Styles responsifs pour différentes tailles d'écran */
        @media (max-width: 768px) {
            .pdf-controls {
                flex-direction: column;
                gap: 1rem;
            }

            .btn-group {
                width: 100%;
                display: flex;
                justify-content: space-between;
            }

            .page-info {
                width: 100%;
                text-align: center;
            }

            .pdf-container {
                padding: 10px;
            }
        }

        @media (max-width: 576px) {
            .card-header h5 {
                font-size: 1rem;
            }

            .btn {
                padding: 0.375rem 0.5rem;
                font-size: 0.875rem;
            }
        }

        /* Optimisation pour les grands écrans */
        @media (min-width: 1200px) {
            .pdf-container {
                max-width: 1140px;
            }
        }

        /* Classe pour le mode zoom */
        .zoom-container {
            position: relative;
            overflow: auto;
            max-height: 80vh;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid pdf-container">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">{{ $resource->name }}</h5>
                    <div class="zoom-controls d-flex gap-2">
                        <button id="zoom-in" class="btn btn-sm btn-outline-gradient gradient-7 rounded-pill">
                            <i class="uil uil-search-plus"></i>
                        </button>
                        <button id="zoom-out" class="btn btn-sm btn-outline-gradient gradient-7 rounded-pill">
                            <i class="uil uil-search-minus"></i>
                        </button>
                        <button id="zoom-reset" class="btn btn-sm btn-outline-gradient gradient-7 rounded-pill">
                            <i class="uil uil-sync"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="pdf-controls d-flex justify-content-between align-items-center mb-3">
                    <div class="btn-group" role="group" aria-label="PDF Navigation">
                        <button id="prev" class="btn btn-outline-primary">
                            <i class="fas fa-chevron-left d-none d-sm-inline"></i>
                            <span>Previous</span>
                        </button>
                        <button id="next" class="btn btn-outline-primary">
                            <span>Next</span>
                            <i class="fas fa-chevron-right d-none d-sm-inline"></i>
                        </button>
                    </div>
                    <div class="page-info">
                        <span class="badge bg-secondary">
                            Page: <span id="page_num" class="fw-bold"></span> / <span id="page_count"></span>
                        </span>
                    </div>
                </div>
                <div class="zoom-container text-center">
                    <canvas id="the-canvas" class="img-fluid rounded"></canvas>
                </div>
                <div class="mt-3">
                    <div class="progress">
                        <div id="pdf-progress" class="progress-bar" role="progressbar" style="width: 0%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/global/lib/pdfjs-modern/build/pdf.mjs') }}" type="module"></script>
    <script type="module">
        var url = @json($resource->getFileUrl());
        var {
            pdfjsLib
        } = globalThis;
        pdfjsLib.GlobalWorkerOptions.workerSrc = @json(asset('assets/global/lib/pdfjs-modern/build/pdf.worker.mjs'));

        var pdfDoc = null,
            pageNum = 1,
            pageRendering = false,
            pageNumPending = null,
            scale = 1.0,
            canvas = document.getElementById('the-canvas'),
            ctx = canvas.getContext('2d');

        // Gestion du zoom
        let currentScale = scale;
        const SCALE_STEP = 0.2;
        const MAX_SCALE = 3;
        const MIN_SCALE = 0.5;

        function updateProgress() {
            const progress = (pageNum / pdfDoc.numPages) * 100;
            document.getElementById('pdf-progress').style.width = progress + '%';
            document.getElementById('pdf-progress').setAttribute('aria-valuenow', progress);
        }

        function calculateInitialScale(viewport) {
            const container = canvas.parentElement;
            const containerWidth = container.clientWidth;
            return (containerWidth - 30) / viewport.width; // -30 pour le padding
        }

        function renderPage(num, useCurrentScale = false) {
            pageRendering = true;
            pdfDoc.getPage(num).then(function(page) {
                // Calculer l'échelle initiale si nécessaire
                if (!useCurrentScale) {
                    const viewport = page.getViewport({
                        scale: 1
                    });
                    currentScale = calculateInitialScale(viewport);
                }

                const viewport = page.getViewport({
                    scale: currentScale
                });
                canvas.height = viewport.height;
                canvas.width = viewport.width;

                const renderContext = {
                    canvasContext: ctx,
                    viewport: viewport
                };

                const renderTask = page.render(renderContext);
                renderTask.promise.then(function() {
                    pageRendering = false;
                    updateProgress();
                    if (pageNumPending !== null) {
                        renderPage(pageNumPending);
                        pageNumPending = null;
                    }
                });
            });
            document.getElementById('page_num').textContent = num;
        }

        function queueRenderPage(num) {
            if (pageRendering) {
                pageNumPending = num;
            } else {
                renderPage(num);
            }
        }

        // Navigation
        function onPrevPage() {
            if (pageNum <= 1) return;
            pageNum--;
            queueRenderPage(pageNum);
        }

        function onNextPage() {
            if (pageNum >= pdfDoc.numPages) return;
            pageNum++;
            queueRenderPage(pageNum);
        }

        // Zoom controls
        function zoomIn() {
            if (currentScale >= MAX_SCALE) return;
            currentScale += SCALE_STEP;
            renderPage(pageNum, true);
        }

        function zoomOut() {
            if (currentScale <= MIN_SCALE) return;
            currentScale -= SCALE_STEP;
            renderPage(pageNum, true);
        }

        function resetZoom() {
            const viewport = pdfDoc.getPage(pageNum).then(page => {
                const viewport = page.getViewport({
                    scale: 1
                });
                currentScale = calculateInitialScale(viewport);
                renderPage(pageNum, true);
            });
        }

        // Event listeners
        document.getElementById('prev').addEventListener('click', onPrevPage);
        document.getElementById('next').addEventListener('click', onNextPage);
        document.getElementById('zoom-in').addEventListener('click', zoomIn);
        document.getElementById('zoom-out').addEventListener('click', zoomOut);
        document.getElementById('zoom-reset').addEventListener('click', resetZoom);

        // Keyboard navigation
        document.addEventListener('keydown', function(e) {
            if (e.key === 'ArrowLeft') onPrevPage();
            if (e.key === 'ArrowRight') onNextPage();
            if (e.key === '+' && e.ctrlKey) zoomIn();
            if (e.key === '-' && e.ctrlKey) zoomOut();
        });

        // Gestion du redimensionnement
        let resizeTimeout;
        window.addEventListener('resize', function() {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(function() {
                if (pdfDoc) {
                    resetZoom();
                }
            }, 250);
        });

        // Touch events pour le mobile
        let touchStartX = 0;
        let touchEndX = 0;

        canvas.addEventListener('touchstart', e => {
            touchStartX = e.changedTouches[0].screenX;
        });

        canvas.addEventListener('touchend', e => {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        });

        function handleSwipe() {
            const swipeThreshold = 50;
            const diff = touchStartX - touchEndX;

            if (Math.abs(diff) > swipeThreshold) {
                if (diff > 0) {
                    onNextPage();
                } else {
                    onPrevPage();
                }
            }
        }

        // Initialisation
        pdfjsLib.getDocument(url).promise.then(function(pdfDoc_) {
            pdfDoc = pdfDoc_;
            document.getElementById('page_count').textContent = pdfDoc.numPages;
            renderPage(pageNum);
        });
    </script>
@endsection

@extends($layout)


@section('styles')
    <style>
        /* Reset des marges et paddings par défaut */
        /* body,
                                                    html {
                                                        margin: 0;
                                                        padding: 0;
                                                        height: 100%;
                                                        width: 100%;
                                                        overflow: hidden;
                                                    } */

        .pdf-container {
            width: 100%;
            height: 100vh;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
        }

        /* .card {
                        height: 100%;
                        border: none;
                        border-radius: 0;
                        display: flex;
                        flex-direction: column;
                    }

                    .card-header {
                        padding: 0.5rem;
                        flex-shrink: 0;
                    }

                    .card-body {
                        flex: 1;
                        padding: 0;
                        display: flex;
                        flex-direction: column;
                        overflow: hidden;
                    } */

        .pdf-controls {
            padding: 0.5rem;
            background: rgba(255, 255, 255, 0.95);
            position: sticky;
            top: 0;
            z-index: 10;
            flex-shrink: 0;
        }

        .zoom-container {
            flex: 1;
            overflow: auto;
            -webkit-overflow-scrolling: touch;
            position: relative;
            background: #f5f5f5;
        }

        #the-canvas {
            display: block;
            margin: 0 auto;
            max-width: 100%;
            height: auto !important;
        }

        .progress {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 3px;
            border-radius: 0;
        }

        /* Style des boutons pour mobile */

        /* Optimisations pour petits écrans */
        @media (max-width: 576px) {
            .card-header {
                padding: 0.25rem;
            }

            .card-title {
                font-size: 1rem;
                margin: 0;
            }

            .pdf-controls {
                padding: 0.25rem;
            }

            .btn-group {
                width: 100%;
                justify-content: space-between;
            }

            .zoom-controls {
                position: fixed;
                bottom: 1rem;
                right: 1rem;
                background: rgba(255, 255, 255, 0.9);
                border-radius: 2rem;
                padding: 0.5rem;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
            }

            .page-info {
                position: fixed;
                bottom: 1rem;
                left: 1rem;
                background: rgba(255, 255, 255, 0.9);
                padding: 0.25rem 0.5rem;
                border-radius: 1rem;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
            }
        }

        /* Optimisation pour mode paysage */
        @media (orientation: landscape) and (max-width: 896px) {
            .card-header {
                position: sticky;
                top: 0;
                z-index: 11;
            }
        }
    </style>
@endsection

@section('content')
    <div class="pdf-container">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <div class="d-flex justify-content-between align-items-center">
                    {{-- <h5 class="card-title">{{ $resource->name }}</h5> --}}
                    <div class="zoom-controls d-flex gap-1">
                        <button id="zoom-in" class="btn btn-sm btn-primary rounded-circle">
                            <i class="uil uil-search-plus"></i>
                        </button>
                        <button id="zoom-out" class="btn btn-sm btn-primary rounded-circle">
                            <i class="uil uil-search-minus"></i>
                        </button>
                        <button id="zoom-reset" class="btn btn-sm btn-primary rounded-circle">
                            <i class="uil uil-sync"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body p-1">
                <div class="pdf-controls d-flex justify-content-between align-items-center">
                    <div class="btn-group" role="group">
                        <button id="prev" class="btn btn-sm btn-primary p-0">
                            <i class="uil uil-angle-left"></i>
                            <span class="d-none d-sm-inline">Previous</span>
                        </button>
                        <button id="next" class="btn btn-sm btn-primary p-0">
                            <i class="uil uil-angle-right"></i>
                            <span class="d-none d-sm-inline">Next</span>
                        </button>
                    </div>
                    <div class="page-info">
                        <span class="badge bg-secondary">
                            Page: <span id="page_num"></span> / <span id="page_count"></span>
                        </span>
                    </div>
                </div>
                <div class="zoom-container">
                    <canvas id="the-canvas"></canvas>
                </div>
                <div class="progress">
                    <div id="pdf-progress" class="progress-bar" role="progressbar" style="width: 0%"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/global/lib/pdfjs-legacy/build/pdf.mjs') }}" type="module"></script>
    <script type="module">
        var url = @json($resource->getFileUrl());
        var {
            pdfjsLib
        } = globalThis;
        pdfjsLib.GlobalWorkerOptions.workerSrc = @json(asset('assets/global/lib/pdfjs-legacy/build/pdf.worker.mjs'));

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

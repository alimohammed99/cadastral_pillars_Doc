<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.css')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .toastish {
            border-radius: 16px;
            overflow: hidden;
            position: relative;
            transform: translateY(-8px);
            opacity: 0;
            animation: toastIn .45s ease forwards;
        }

        @keyframes toastIn {
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .toastish .toastish-bar {
            position: absolute;
            left: 0;
            bottom: 0;
            height: 4px;
            width: 100%;
            transform-origin: left;
            animation: barShrink linear forwards;
        }

        @keyframes barShrink {
            from {
                transform: scaleX(1);
            }

            to {
                transform: scaleX(0);
            }
        }

        .toastish .btn-close {
            opacity: .85;
            filter: none;
        }

        .toastish .btn-close:hover {
            opacity: 1;
        }
    </style>
    <style>
        .pillar-modal {
            border-radius: 18px;
            overflow: hidden;
        }

        .pillar-modal-header {
            background: linear-gradient(135deg, rgba(13, 110, 253, .10), rgba(25, 135, 84, .10));
            border-bottom: 1px solid rgba(0, 0, 0, .06);
            padding: 16px 18px;
        }

        .pillar-modal-footer {
            border-top: 1px solid rgba(0, 0, 0, .06);
            padding: 14px 18px;
        }

        .pillar-input {
            border-radius: 12px;
            padding: 10px 12px;
        }

        .pillar-input:focus {
            box-shadow: 0 0 0 .2rem rgba(13, 110, 253, .12);
            border-color: rgba(13, 110, 253, .35);
        }

        .preview-box {
            border: 1px dashed rgba(0, 0, 0, .18);
            border-radius: 14px;
            padding: 10px;
            background: rgba(0, 0, 0, .02);
        }

        .preview-box img {
            width: 100%;
            max-height: 320px;
            object-fit: contain;
            border-radius: 12px;
            display: block;
        }

        .custom-select-beauty {
            height: 46px;
            border-radius: 12px;
            padding: 10px 12px;
            appearance: none;
            background-image: url("data:image/svg+xml;utf8,<svg fill='%23666' height='20' viewBox='0 0 24 24' width='20' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/></svg>");
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 18px;
        }

        /* Better vertical spacing inside modal */
        .pillar-modal .row>div {
            margin-bottom: 18px;
        }

        .pillar-modal label {
            margin-bottom: 6px;
        }

        .pillar-modal small {
            display: block;
            margin-top: 4px;
        }
    </style>

    <script>
        //  Instant image preview for any input with data-preview-target
        document.addEventListener('change', function(e) {
            const input = e.target;
            if (!input.matches('input[type="file"][data-preview-target]')) return;

            const file = input.files && input.files[0];
            const targetSel = input.getAttribute('data-preview-target');
            const img = document.querySelector(targetSel);

            // optional wrap
            const wrapSel = input.getAttribute('data-preview-wrap');
            const wrap = wrapSel ? document.querySelector(wrapSel) : null;

            // Add modal uses a fixed wrap id
            const addWrap = document.getElementById('addPlanPreviewWrap');

            if (!file || !img) return;

            if (!file.type.startsWith('image/')) return;

            const url = URL.createObjectURL(file);
            img.src = url;

            // reveal preview box
            if (wrap) {
                // if wrap contains a hidden preview-box, show it
                const box = wrap.querySelector('.preview-box');
                if (box) box.classList.remove('d-none');
            }
            if (addWrap && targetSel === '#addPlanPreview') {
                addWrap.classList.remove('d-none');
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const modalId = @json(session('open_modal'));

            if (!modalId) return;

            const modalElement = document.getElementById(modalId);

            if (!modalElement) return;

            // Ensure Bootstrap is available
            if (typeof bootstrap !== 'undefined') {
                const modal = new bootstrap.Modal(modalElement);
                modal.show();
            } else {
                console.error('Bootstrap JS not loaded');
            }
        });
    </script>
</head>

<body>
    <div class="container-scroller">
        @include('admin.navbar')
        <div class="container-fluid page-body-wrapper">
            @include('admin.sidebar')
            <div class="main-panel">
                <div class="content-wrapper">
                    @include('admin.message_feedback')
                    @include('admin.body')
                </div>
            </div>
        </div>
        @include('admin/script')

        <script>
            // ✅ File preview (Add + Edit)
            document.addEventListener('change', function(e) {
                const input = e.target;
                if (!input.matches('input[type="file"][data-preview-target]')) return;

                const file = input.files && input.files[0];
                if (!file) return;
                if (!file.type.startsWith('image/')) return;

                const img = document.querySelector(input.getAttribute('data-preview-target'));
                const wrap = document.querySelector(input.getAttribute('data-preview-wrap'));

                if (!img || !wrap) return;

                img.src = URL.createObjectURL(file);

                // show preview box
                wrap.classList.remove('d-none');
                const box = wrap.querySelector('.preview-box');
                if (box) box.classList.remove('d-none');
            });

            // ✅ Auto-open modal after validation error
            document.addEventListener('DOMContentLoaded', function() {
                const modalId = @json(session('open_modal'));
                if (!modalId) return;

                const el = document.getElementById(modalId);
                if (!el) return;

                const m = new bootstrap.Modal(el);
                m.show();
            });
        </script>
</body>

</html>

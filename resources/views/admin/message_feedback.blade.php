<style>
    .feedback-container {
        position: fixed;
        top: 30px;
        right: 30px;
        z-index: 10000;
        display: flex;
        flex-direction: column;
        gap: 15px;
        width: 400px;
        pointer-events: none;
    }
    .bubble-toast {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 24px;
        padding: 20px;
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        border: 1px solid rgba(255,255,255,0.3);
        display: flex;
        align-items: flex-start;
        gap: 16px;
        animation: slideInBubble 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        cursor: pointer;
        pointer-events: auto;
        position: relative;
        overflow: hidden;
    }
    @keyframes slideInBubble {
        from { opacity: 0; transform: translateX(50px) scale(0.9); }
        to { opacity: 1; transform: translateX(0) scale(1); }
    }
    .bubble-toast.sticky {
        border: 2px solid #0d6efd;
    }
    .bubble-toast.sticky .hold-indicator {
        background: #0d6efd;
        color: white;
    }
    .hold-indicator {
        position: absolute;
        bottom: 0;
        right: 20px;
        font-size: 10px;
        font-weight: 800;
        padding: 2px 10px;
        border-radius: 10px 10px 0 0;
        background: #f1f5f9;
        color: #94a3b8;
        text-transform: uppercase;
        transition: all 0.3s;
    }
    .bubble-progress {
        position: absolute;
        bottom: 0;
        left: 0;
        height: 4px;
        background: currentColor;
        opacity: 0.2;
        width: 100%;
        transform-origin: left;
    }
</style>

<div class="feedback-container">
@if (session('success'))
    <div class="bubble-toast text-success" role="alert" data-ttl="6000">
        <div class="bubble-progress"></div>
        <div style="width:48px; height:48px; border-radius:16px; flex-shrink:0; display:flex; align-items:center; justify-content:center; background:rgba(25,135,84,.12);">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0z" />
                <path fill="#fff" d="M12.03 5.97a.75.75 0 0 0-1.08-1.04L7.477 8.417 5.384 6.323a.75.75 0 0 0-1.06 1.06l2.65 2.65a.75.75 0 0 0 1.08 0l3.975-4.063z" />
            </svg>
        </div>
        <div class="flex-grow-1">
            <div class="fw-bold" style="font-size:16px; color: #1e293b;">Action Successful</div>
            <div style="font-size:14px; color: #64748b;">{{ session('success') }}</div>
        </div>
        <div class="hold-indicator">Click to hold</div>
    </div>
@endif

@if ($errors->any())
    <div class="bubble-toast text-danger" role="alert" data-ttl="9000">
        <div class="bubble-progress"></div>
        <div style="width:48px; height:48px; border-radius:16px; flex-shrink:0; display:flex; align-items:center; justify-content:center; background:rgba(220,53,69,.12);">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.964 0L.165 13.233c-.457.778.091 1.767.982 1.767h13.706c.89 0 1.438-.99.982-1.767L8.982 1.566z" />
                <path fill="#fff" d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.55.55 0 0 1-1.1 0L7.1 4.995z" />
            </svg>
        </div>
        <div class="flex-grow-1">
            <div class="fw-bold" style="font-size:16px; color: #1e293b;">Validation Conflict</div>
            <ul class="mb-0 mt-1 ps-3" style="font-size:13.5px; color: #475569;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <div class="hold-indicator" style=>Click to hold</div>
    </div>
@endif
</div>

<script>
document.querySelectorAll('.bubble-toast').forEach(toast => {
    const ttl = parseInt(toast.dataset.ttl) || 6000;
    const progress = toast.querySelector('.bubble-progress');
    const indicator = toast.querySelector('.hold-indicator');
    let startTime = Date.now();
    let isPersistent = false;

    const animate = () => {
        if (isPersistent) return;
        const elapsed = Date.now() - startTime;
        const remaining = 1 - (elapsed / ttl);

        if (remaining <= 0) {
            dismiss();
        } else {
            progress.style.transform = `scaleX(${remaining})`;
            requestAnimationFrame(animate);
        }
    };

    const dismiss = () => {
        toast.style.transition = 'all 0.5s ease';
        toast.style.opacity = '0';
        toast.style.transform = 'translateX(100px)';
        setTimeout(() => toast.remove(), 500);
    };

    toast.addEventListener('click', (e) => {
        if (isPersistent) {
            dismiss();
        } else {
            isPersistent = true;
            toast.classList.add('sticky');
            indicator.innerText = 'Persistent - Click to Close';
            progress.style.display = 'none';
        }
    });

    requestAnimationFrame(animate);
});
</script>

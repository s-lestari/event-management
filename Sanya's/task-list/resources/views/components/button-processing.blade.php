@props(['text' => 'Submit', 'id' => 'submitBtn'])

<button type="submit"
        class="btn {{ strtolower($text) === 'delete' ? 'delete-button' : '' }} processing-button"
        id="{{ $id }}">
    {{ $text }}
</button>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Semua tombol submit yang perlu processing
        const processingButtons = document.querySelectorAll('.processing-button');

        processingButtons.forEach(button => {
            const form = button.closest('form');
            if (form) {
                form.addEventListener('submit', function () {
                    button.disabled = true;
                    button.innerText = button.classList.contains('delete-button') ? 'Deleting...' : 'Processing...';
                });
            }
        });

        // Khusus untuk tombol delete (verifikasi confirm)
        const deleteButtons = document.querySelectorAll('.delete-button');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function (event) {
                if (!confirm('Are you sure you want to delete this task?')) {
                    event.preventDefault();
                }
            });
        });
    });
</script>
@endpush

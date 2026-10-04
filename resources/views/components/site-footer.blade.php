<footer class="mt-16 bg-ink text-paper">
    <div class="mx-auto max-w-[87.5rem] px-5 md:px-10">
        <div class="py-12 md:py-16 lg:py-20">
            <p class="max-w-[28rem] text-body-l text-paper-sunk">
                Clear financial articles and practical information for everyday decisions.
            </p>
        </div>

        {{-- Keep the footer compact because the header already displays the FinanceBlog name. --}}
        <div class="border-t border-ink-soft py-8">
            <span class="font-label text-label-s text-ink-faint">
                &copy; {{ now()->year }} FinanceBlog
            </span>
        </div>
    </div>
</footer>

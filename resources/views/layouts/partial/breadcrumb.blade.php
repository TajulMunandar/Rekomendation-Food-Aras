<div class="flex gap-2 text-sm font-bold bg-primary-100 text-white p-2 px-2 rounded-md">
    <a class="flex gap-1" href="/">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-[13pt]">
            <path
                d="M11.47 3.841a.75.75 0 0 1 1.06 0l8.69 8.69a.75.75 0 1 0 1.06-1.061l-8.689-8.69a2.25 2.25 0 0 0-3.182 0l-8.69 8.69a.75.75 0 1 0 1.061 1.06l8.69-8.689Z" />
            <path
                d="m12 5.432 8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 0 1-.75-.75v-4.5a.75.75 0 0 0-.75-.75h-3a.75.75 0 0 0-.75.75V21a.75.75 0 0 1-.75.75H5.625a1.875 1.875 0 0 1-1.875-1.875v-6.198a2.29 2.29 0 0 0 .091-.086L12 5.432Z" />
        </svg>


        <p>Home</p>
    </a>
    <p>></p>
    <?php $link = ''; ?>
    @for ($i = 1; $i <= count(Request::segments()); $i++)
        @if (($i < count(Request::segments())) & ($i > 0))
            <?php $link .= '/' . Request::segment($i); ?>
            <a href="<?= $link ?>">{{ ucwords(str_replace('-', ' ', Request::segment($i))) }}</a> >
        @else
            {{ ucwords(str_replace('-', ' ', Request::segment($i))) }}
        @endif
    @endfor
</div>

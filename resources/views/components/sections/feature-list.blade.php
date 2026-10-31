@props([
    'items' => [], // [['icon' => '', 'title' => '', 'text' => '']]
    'cols' => 3,
    'tone' => 'light', // light | dark
])

<ul {{ $attributes->class(['hairline-grid border border-line sm:grid-cols-2', $tone === 'dark' ? 'border-white/10' : '', $cols === 4 ? 'lg:grid-cols-4' : ($cols === 2 ? '' : 'lg:grid-cols-3')]) }} data-stagger>
    @foreach ($items as $item)
        <li class="group flex flex-col p-7 sm:p-9">
            @isset($item['icon'])
                <span class="grid size-12 place-items-center {{ $tone === 'dark' ? 'bg-white/8 text-accent group-hover:bg-accent group-hover:text-ink' : 'bg-cream text-ink-2 group-hover:bg-accent' }} transition-colors duration-500">
                    <x-icon :name="$item['icon']" class="size-[1.35rem]" />
                </span>
            @endisset
            <h3 class="mt-8 font-display text-xl font-semibold tracking-[-0.02em]">{{ t($item['title']) }}</h3>
            <p class="mt-3 leading-relaxed {{ $tone === 'dark' ? 'text-white/60' : 'text-stone' }}">{{ t($item['text']) }}</p>
        </li>
    @endforeach
</ul>

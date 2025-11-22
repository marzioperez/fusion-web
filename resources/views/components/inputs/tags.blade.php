@props([
    'options' => [],
    'wireModel' => null,
    'placeholder' => 'Write and press enter...',
    'id' => 'tags-input-' . \Illuminate\Support\Str::random(6)
])
<div
    x-data="{
        query: '',
        open: false,
        options: @js(collect($options)->map(fn($a)=>['id'=>$a['id']??null,'name'=>$a['name']??''])->values()),
        selected: @entangle($wireModel).live,
        get filtered(){
            if(!this.query) return this.options;
            const q = this.query.toLowerCase();
            return this.options.filter(o => o.name.toLowerCase().includes(q) && !this.selected.map(s => (typeof s === 'string' ? s : s.name)).includes(o.name));
        },
        add(tag){
            const name = (typeof tag === 'string') ? tag : tag.name;
            if(!name) return;
            const exists = this.selected.map(s => (typeof s === 'string' ? s : s.name)).includes(name);
            if(!exists){ this.selected = [...(this.selected || []), name]; }
            this.query = '';
            this.open = false;
        },
        remove(index){
            const arr = [...(this.selected || [])];
            arr.splice(index,1);
            this.selected = arr;
        },
        onKeydown(e){
            if(e.key === 'Enter' || e.key === ','){
                e.preventDefault();
                if(this.query.trim()){ this.add(this.query.trim()); }
            } else if(e.key === 'Backspace' && !this.query && (this.selected||[]).length){
                this.remove((this.selected||[]).length-1);
            }
        }
    }"
    class="w-full relative"
>
    <div class="flex flex-wrap items-center gap-2">
        <input id="allergies" type="text" x-model="query" x-on:keydown="onKeydown($event)" x-on:focus="open=true" x-on:blur="setTimeout(()=>open=false, 120)" placeholder="{{ $placeholder }}" class="w-full" />

        <template x-for="(tag, i) in selected" :key="(typeof tag==='string'?tag:tag.name)">
            <div class="inline-flex items-center gap-1 rounded-full bg-primary/10 px-2 py-1 text-xs">
                <div x-text="typeof tag==='string' ? tag : tag.name"></div>
                <button type="button" class="-mr-1 inline-flex h-4 w-4 items-center justify-center rounded-full hover:bg-primary/20" x-on:click.prevent="remove(i)">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-3 w-3">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </template>
    </div>

    <!-- Suggestions dropdown -->
    <div x-cloak x-show="open && filtered.length" class="absolute top-full z-20 w-full h-[100px] overflow-y-scroll rounded-md border border-gray-200 bg-white shadow-lg">
        <template x-for="opt in filtered" :key="opt.id ?? opt.name">
            <button type="button" class="block w-full text-left px-3 py-2 hover:bg-gray-50 text-sm" x-on:click.prevent="add(opt)">
                <span x-text="opt.name"></span>
            </button>
        </template>
    </div>

    <!-- Hidden input to keep browser happy (not strictly needed with entangle) -->
    <input type="hidden" name="allergies" :value="JSON.stringify(selected)">
</div>

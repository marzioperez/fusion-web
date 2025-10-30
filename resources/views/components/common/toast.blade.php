<div
    x-data="{
        messages: [],
        add(e) {
            this.messages.push({
                id: e.timeStamp,
                type: e.detail.type,
                message: e.detail.message,
                title: e.detail.title
            })
        },
        remove(message) {
            this.messages = this.messages.filter(i => i.id !== message.id)
        }
    }"
    x-on:toast.window="add($event)"
    class="toast"
    role="status"
    aria-live="polite"
>
    <template x-for="message in messages" :key="message.id">
        <div x-data="{
                show: false,
                init() {
                    this.$nextTick(() => this.show = true)
                    setTimeout(() => this.transitionOut(), 4000)
                },
                transitionOut() {
                    this.show = false
                    setTimeout(() => this.remove(this.message), 500)
                }
            }"
            x-show="show"
            x-transition.duration.500ms
            class="body"
        >
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg x-show="message.type === 'success'" width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="4" y="4" width="17" height="16" fill="white"/>
                        <path d="M12.5 0C5.59644 0 0 5.59644 0 12.5C0 19.4036 5.59644 25 12.5 25C19.4036 25 25 19.4036 25 12.5C25 5.59644 19.4036 0 12.5 0ZM17.8635 5.85479L20.4605 8.45183L12.3489 16.565L9.76715 19.1452L7.1701 16.5482L4.53948 13.916L7.11975 11.3357L9.75038 13.9679L17.8635 5.85479Z" fill="#009600"/>
                    </svg>

                    <svg x-show="message.type === 'error'" class="w-6 h-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>

                    <svg x-show="message.type === 'info'" class="w-6 h-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>

                    <svg x-show="message.type === 'warning'" class="w-6 h-6 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.618 5.984A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016zM12 9v2m0 4h.01" />
                    </svg>
                </div>

                <div class="ml-3 flex-1 pt-0.5">
                    <p x-text="message.title" class="font-bold text-gray-900 text-sm/6"></p>
                    <p x-text="message.message" :class="(message.title ? 'mt-1' : '')" class="text-sm font-medium text-gray-500"></p>
                </div>
                <div class="flex flex-shrink-0 ml-4">
                    <button @click="transitionOut()" class="inline-flex text-gray-400 transition duration-150 ease-in-out focus:outline-none focus:text-gray-500">
                        <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </template>
</div>

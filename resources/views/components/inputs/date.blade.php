<div wire:ignore class="relative">
    <input
        x-data="{
             value: @entangle($attributes->wire('model')),
             init() {
                 $watch('value', value => this.instance.setDate(value, false));
                 this.instance = flatpickr(this.$refs.input, {{ json_encode((object)$options) }});
             }
        }"
        x-init="init"
        x-ref="input"
        type="text"
        {{ $attributes }}
    />
    <svg class="absolute bottom-2 right-0" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M6.66602 2H13.333V0H15.5557V2H17.7773C19.0029 2 20 2.89702 20 4V18C19.9998 19.1028 19.0028 20 17.7773 20H2.22168C0.996344 19.9999 0.000195187 19.1028 0 18V4C0 2.89708 0.996224 2.0001 2.22168 2H4.44434V0H6.66602V2ZM2.22168 18H17.7783L17.7773 6H2.22168V18ZM6.66113 15H4.99512V13.333H6.66113V15ZM10.8115 15H9.14551V13.333H10.8115V15ZM14.9971 15H13.3311V13.333H14.9971V15ZM6.66113 10.833H4.99512V9.16699H6.66113V10.833ZM10.8115 10.833H9.14551V9.16699H10.8115V10.833ZM14.9678 10.833H13.3008V9.16699H14.9678V10.833Z" fill="#2B3CA2"/>
    </svg>
</div>

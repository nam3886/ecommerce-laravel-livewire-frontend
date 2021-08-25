<form wire:submit.prevent='subscribe'>
    <div class="form-fild-newsletter-single-item input-color--golden">
        <input type="email" placeholder="Your email address..." required wire:model.defer='email'>
        <button type="submit">SUBSCRIBE!</button>
    </div>
</form>

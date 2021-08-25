<div>
    <x-partials.breadcrumb :title="__('contact us')" />

    <div class="map-section" data-aos="fade-up" data-aos-delay="0" wire:ignore.self>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="mapouter">
                        <div class="gmap_canvas">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31347.593563082366!2d106.69605932641733!3d10.853399053422343!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752872ceb86131%3A0x5d74287fea01db7d!2zSGnhu4dwIELDrG5oIFBoxrDhu5tjLCBUaOG7pyDEkOG7qWMsIFRow6BuaCBwaOG7kSBI4buTIENow60gTWluaCwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1620970697081!5m2!1svi!2s"
                                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> {{-- ...::::End  Map Section:::... --}}

    {{-- ...::::Start Contact Section:::... --}}
    <div class="contact-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="contact-details-wrapper section-top-gap-100" data-aos="fade-up" data-aos-delay="0"
                        wire:ignore.self>
                        <div class="contact-details">
                            @include('partials.body.display.phone-call')
                            @include('partials.body.display.mail-site')
                            @include('partials.body.display.address')
                        </div>
                        <div class="contact-social">
                            <h4>Follow Us</h4>
                            <x-display.social-link />
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="contact-form section-top-gap-100" data-aos="fade-up" data-aos-delay="200"
                        wire:ignore.self>
                        <h3>Get In Touch</h3>
                        <form wire:submit.prevent='mail'>
                            <div class="row">
                                <div class="col-lg-6">
                                    <x-inputs.group class='mb-20' model='user.name' for='contact-name'>
                                        <x-slot name='label'>
                                            Name <span class='required'>*</span>
                                        </x-slot>
                                        <x-inputs.required.text wire:model.defer='user.name' id='contact-name' />
                                    </x-inputs.group>
                                </div>
                                <div class="col-lg-6">
                                    <x-inputs.group class='mb-20' model='user.email' for='contact-email'>
                                        <x-slot name='label'>
                                            Email <span class='required'>*</span>
                                        </x-slot>
                                        <x-inputs.required.text wire:model.defer='user.email' id='contact-email'
                                            type="email" />
                                    </x-inputs.group>
                                </div>
                                <div class="col-lg-12">
                                    <x-inputs.group class='mb-20' model='user.subject' for='contact-subject'>
                                        <x-slot name='label'>
                                            Subject <span class='required'>*</span>
                                        </x-slot>
                                        <x-inputs.required.text wire:model.defer='user.subject' id='contact-subject' />
                                    </x-inputs.group>
                                </div>
                                <div class="col-lg-12">
                                    <x-inputs.group class='mb-20' model='user.message' for='contact-message'>
                                        <x-slot name='label'>
                                            Your Message <span class='required'>*</span>
                                        </x-slot>
                                        <x-inputs.required.textarea id="contact-message" cols="30" rows="10"
                                            wire:model.defer='user.message' />
                                    </x-inputs.group>
                                </div>
                                <div class="col-lg-12">
                                    <x-inputs.button-spinner class="btn btn-lg btn-black-default-hover" type="submit">
                                        SEND
                                    </x-inputs.button-spinner>
                                </div>
                                <p class="form-messege"></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('title', 'Contact Us')

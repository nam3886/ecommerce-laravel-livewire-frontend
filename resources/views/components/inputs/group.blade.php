@props(['model' => null, 'for' => null])

<div {{ $attributes->merge(['class' => 'default-form-box']) }}>
    <label for='{{ $for }}'>
        {{ $label ?? null }}
    </label>
    {{ $slot }}

    @error($model)
        <div class='mt-2 d-inline'>
            <span class="error-validate">{{ $message }}</span>
        </div>
    @enderror
</div>

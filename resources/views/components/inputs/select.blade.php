@props(['options', 'title'])

<select {{ $attributes }}>
    <option value="0">Select {{ $title }}</option>

    @foreach ($options as $option)
        <option value="{{ $option['id'] }}">{{ $option['name'] }}</option>
    @endforeach
</select>

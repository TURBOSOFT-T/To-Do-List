@props(['country' => ''])

<div data-mdb-input-init class="form-outline">
  <label class="form-label" for="country">@lang('Country')</label>
  <input

  id="country"
     {{--  class="h-full-width" --}}
     class="form-control"
      type="text"
      name="country"

      value="{{ old('county', $country) }}"
      required
      autofocus>
</div>

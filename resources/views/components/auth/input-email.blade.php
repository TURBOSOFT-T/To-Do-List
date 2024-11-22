@props(['email' => ''])

<div class="input-box">
    <label>Mail Adresi</label>
  <input
      id="email"

     {{--  class="h-full-width" --}}
      type="email"
      name="email"

      value="{{ old('email', $email) }}"
      required
      >
</div>

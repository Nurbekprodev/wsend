<svg {{ $attributes->merge(['viewBox' => '0 0 512 512']) }}>
  <defs>
    <linearGradient id="bgGradient" x1="0" y1="0" x2="512" y2="512">
      <stop offset="0%" stop-color="#4F46FF"/>
      <stop offset="100%" stop-color="#7C3AED"/>
    </linearGradient>

    <style>
      .icon {
        stroke: white;
        stroke-width: 18;
        stroke-linecap: round;
        stroke-linejoin: round;
        fill: none;
      }
    </style>
  </defs>

  <circle cx="256" cy="256" r="240" fill="url(#bgGradient)"/>

  <path class="icon"
        d="M170 300
           C170 255, 205 230, 240 230
           C250 195, 285 175, 320 190
           C350 200, 365 230, 360 255
           C385 260, 400 280, 400 305
           C400 335, 375 360, 340 360
           H210
           C185 360, 170 335, 170 300Z"/>

  <path class="icon" d="M256 330 V250"/>
  <polyline class="icon" points="230,275 256,245 282,275"/>

</svg>
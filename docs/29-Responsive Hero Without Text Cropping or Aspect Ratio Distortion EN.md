# Day 29. Responsive Hero Without Text Cropping or Aspect Ratio Distortion

## Goal of the day

Make the Hero slider reliable across different screen sizes when the text is already embedded inside a JPG/PNG banner and cannot be moved into a separate HTML layer.

The main requirement was simple: the image must remain readable on standard and wide monitors, without losing text at the edges and without looking stretched or vertically compressed.

---

## Complex things in simple words

The problem was not the slider itself and not the CMS. The slider was switching images correctly, but the browser was trying to fit a banner of one shape into a Hero block with another shape.

With `cover`, an image can fill the whole area but some of its edges may be cropped. That is often acceptable for a photograph, but not for a poster where the cropped area may contain text.

With `contain`, the complete image remains visible, but noticeable empty side areas can appear on a wide screen.

With `fill`, the empty areas disappear, but width and height are stretched independently, which can make the design look vertically compressed.

The final solution therefore does not try to stretch the image harder. Instead, the Hero and the prepared banners use the same aspect ratio.

---

## What was implemented

### 1. A unified Hero banner format

For slides with text embedded into the artwork, a common wide format was adopted:

```text
1920 × 625 px
```

This aspect ratio becomes part of the component rules.

### 2. Images prepared without redrawing their content

The original artwork does not need to be recreated. Its composition, text and graphics remain unchanged. Missing space is added around the original artwork using a background colour appropriate for each banner.

This allows different source images to be converted into one consistent Hero format without changing their actual content.

### 3. Fixed Hero height removed

Previously the Hero used a fixed height. On screens with a different width, this created a mismatch between the proportions of the container and the proportions of the banner.

The Hero now uses:

```css
.hero {
    position: relative;
    width: 100%;
    aspect-ratio: 1920 / 625;
    height: auto;
    overflow: hidden;
}
```

In simple terms: the Hero width follows the screen width, while the browser automatically calculates the correct height.

### 4. Natural image proportions restored

Prepared image-only banners use:

```css
.hero-slide--image-only img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center center;
}
```

Because the Hero and the prepared banner now share the same aspect ratio, the image no longer needs artificial horizontal or vertical stretching.

### 5. Conflicting responsive heights removed

Separate fixed Hero heights were removed from responsive media queries. Tablet and mobile rules therefore no longer force the component back into the old geometry.

The existing controls and behaviour — arrows, dots, slide click navigation, text modes and switching logic — remain intact.

---

## How to achieve the same result from the start

If this requirement had been defined from the beginning, the straight path would be:

1. Check whether the text is embedded inside the graphic file.
2. Choose one wide format for such banners — 1920 × 625 px.
3. Prepare the source images for that canvas without changing their content.
4. Give the Hero the same aspect ratio with `aspect-ratio`.
5. Remove fixed component heights.
6. Use proportional image rendering instead of forced stretching.
7. Test the result on a screen with a different width.

This solves the underlying cause rather than repeatedly correcting individual visual symptoms.

---

## Result

The Hero now scales with the available screen width while preserving its intended geometry. Banners with embedded text remain readable, avoid prominent side gaps, and are no longer vertically distorted.

The existing Hero architecture did not need to be rebuilt: the CMS, PHP and JavaScript keep their existing responsibilities, while the responsive correction is handled by image preparation and CSS.

---

## Day result

**Score: 5/5.**

The result is more than a cosmetic adjustment to several images. The project now has a clear rule for future Hero content: banners with embedded text are prepared in one wide format, and the Hero preserves the same proportions across screen sizes.

This makes the component predictable and significantly reduces the risk of the same problem returning when new slides are added.
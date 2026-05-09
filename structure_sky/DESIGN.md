```markdown
# Design System Strategy: Architectural Precision

## 1. Overview & Creative North Star
The design system for Space Solutions of Florida Inc. is built upon the Creative North Star: **"The Architectural Monolith."** 

Remodeling is the art of transformation—taking chaotic space and imposing order, luxury, and efficiency. This system moves away from "web-template" layouts by embracing **Editorial Asymmetry**. We replace traditional grids with intentional white space and overlapping layers that mimic architectural blueprints. By utilizing high-contrast typography scales and tonal depth, we communicate a sense of permanent, high-end craftsmanship. This is not just a website; it is a digital portfolio of structural integrity.

---

## 2. Colors & Atmospheric Depth
Our palette is rooted in the "Deep Navy" of structural steel and the "Corporate Blue" of precision engineering.

### The "No-Line" Rule
To maintain a premium, custom feel, **1px solid borders are strictly prohibited for sectioning.** Physical boundaries must be defined solely through background color shifts or subtle tonal transitions. 
*   *Example:* A `surface-container-low` section sitting on a `surface` background provides all the separation a user needs without the "cheapness" of a stroke.

### Surface Hierarchy & Nesting
Treat the UI as a series of physical layers—like stacked sheets of fine paper or frosted glass. Use the `surface-container` tiers to define importance:
*   **Base:** `surface` (#f7f9fb)
*   **Sectioning:** `surface-container-low` (#f2f4f6)
*   **Interactive Cards:** `surface-container-lowest` (#ffffff) for maximum "pop" and perceived cleanliness.
*   **Overlays:** `surface-container-highest` (#e0e3e5) for contextual depth.

### The "Glass & Gradient" Rule
To break the monotony of flat "corporate" blue, floating elements (like navigation bars or hovering quote calculators) should utilize **Glassmorphism**.
*   **Token:** Use semi-transparent `primary-container` (#0b2950 at 80% opacity) with a `backdrop-filter: blur(12px)`.
*   **CTAs:** Use subtle linear gradients (e.g., `primary` to `primary-container`) to provide a "sheen" that mimics polished surfaces.

---

## 3. Typography: The Editorial Voice
We utilize a dual-sans-serif approach to balance architectural strength with modern legibility.

*   **Display & Headlines (Manrope):** Chosen for its geometric precision and wide apertures. Use `display-lg` (3.5rem) with tight letter-spacing (-0.02em) to create authoritative, "magazine-style" headers.
*   **Body & Labels (Inter):** The workhorse of the system. Inter provides maximum readability for technical specifications and project descriptions.
*   **Visual Hierarchy:** High contrast is key. Pair a `display-md` headline in `on_surface` (#191c1e) with a `body-md` description in `on_surface_variant` (#44474e) to create a clear, professional narrative flow.

---

## 4. Elevation & Depth: Tonal Layering
Traditional drop shadows are often messy. In this system, depth is an extension of the material itself.

*   **The Layering Principle:** Avoid shadows where possible. Achieve lift by placing a `surface-container-lowest` card on a `surface-container-low` background. This "Soft-Lift" mimics natural lighting.
*   **Ambient Shadows:** For floating CTAs or Modals, use "Ambient Shadows." 
    *   *Spec:* `0px 24px 48px rgba(11, 41, 80, 0.06)`. Note the use of the `primary` color in the shadow tint rather than pure black.
*   **The "Ghost Border" Fallback:** If a boundary is required for accessibility, use a **Ghost Border**: `outline-variant` (#c4c6cf) at **15% opacity**. It should be felt, not seen.

---

## 5. Components: Structural Elements

### Buttons: The "Solid-State" Action
*   **Primary:** `primary` (#001431) background with `on_primary` (#ffffff) text. Use `rounded-md` (0.375rem) for a look that feels sturdy but not "bubbly."
*   **Secondary:** Glassmorphic style. `surface-container-high` with a subtle `ghost-border`.
*   **Hover State:** Transition background color by 10% brightness and increase the corner radius slightly to `rounded-lg` (0.5rem) to indicate tactile responsiveness.

### Cards & Lists: The "No-Divider" Mandate
*   **Cards:** Forbid internal divider lines. Separate header, body, and footer content using the **Spacing Scale** (e.g., `8` (2.75rem) gap between sections). 
*   **Remodeling Gallery Cards:** Use `surface-container-lowest` with an inset image that has a `rounded-sm` corner, creating a "frame within a frame" effect.

### Input Fields: Precision Entry
*   **Style:** Minimalist. No background fill—only a bottom border using `outline` (#74777f) at 30% opacity. 
*   **Focus State:** The bottom border transforms into a 2px solid `secondary` (#285bb4) line. This mimics a draftman's pencil line.

### Additional Signature Components:
*   **The "Space Calculator" Chip:** Interactive selection chips using `secondary_container` with `on_secondary_container` text to highlight specific remodeling options (e.g., "Kitchen," "Closet," "Garage").
*   **Progress Steppers:** Use a vertical, asymmetrical timeline to show "Project Phases" (Consultation -> Design -> Build), utilizing `primary` for active states and `outline_variant` for upcoming ones.

---

## 6. Do’s and Don’ts

### Do:
*   **Embrace White Space:** Use the `20` (7rem) and `24` (8.5rem) spacing tokens between major sections to let the high-end photography breathe.
*   **Use Tonal Shifts:** Always prefer a color shift over a line when separating content.
*   **Align to the Type:** Use the baseline of your headlines to align secondary imagery.

### Don’t:
*   **No Pure Black Shadows:** Never use `#000000` for shadows; it "muddies" the clean, light-gray background.
*   **No Fully Rounded Buttons:** Avoid `rounded-full` for primary actions. We are a remodeling company; we value structure and corners. Stick to `md` or `lg`.
*   **No Standard Grids:** Avoid placing three cards in a perfect horizontal row. Try a "2+1" layout where the first card is larger, creating an editorial focal point.

---
**Director's Note:** Every pixel must feel like it was placed by a master carpenter. If a layout feels "default," add more white space and remove a line. Efficiency is found in what we leave out.```
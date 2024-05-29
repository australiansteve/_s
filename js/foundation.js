import { Foundation } from 'foundation-sites/js/foundation.core'
import { AccordionMenu } from 'foundation-sites/js/foundation.accordionMenu'
import { DropdownMenu } from 'foundation-sites/js/foundation.dropdownMenu'
import { Sticky } from 'foundation-sites/js/foundation.sticky'
import { Equalizer } from 'foundation-sites/js/foundation.equalizer'
import { OffCanvas } from 'foundation-sites/js/foundation.offcanvas'
import jquery from 'jquery';

function initFoundation() {
  // Include the Foundation Modules that we'll use in the app
  Foundation.plugin(AccordionMenu, 'AccordionMenu')
  Foundation.plugin(DropdownMenu, 'DropdownMenu')
  Foundation.plugin(Sticky, 'Sticky')
  Foundation.plugin(Equalizer, 'Equalizer')
  Foundation.plugin(OffCanvas, 'OffCanvas')
  
  window.jQuery = jquery;
  window.$ = jquery;

  // Add jQuery to Foundation
  Foundation.addToJquery(jquery)

  // Kick off foundation
  jquery(document).foundation()
}

// Start Foundation JS Modules
initFoundation();
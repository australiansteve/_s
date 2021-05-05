import { Foundation } from 'foundation-sites/js/foundation.core'
import { AccordionMenu } from 'foundation-sites/js/foundation.accordionMenu'
import { Sticky } from 'foundation-sites/js/foundation.sticky'
import { Equalizer } from 'foundation-sites/js/foundation.equalizer'
import { OffCanvas } from 'foundation-sites/js/foundation.offcanvas'

function initFoundation() {
  // Include the Foundation Modules that we'll use in the app
  Foundation.plugin(AccordionMenu, 'AccordionMenu')
  Foundation.plugin(Sticky, 'Sticky')
  Foundation.plugin(Equalizer, 'Equalizer')
  Foundation.plugin(OffCanvas, 'OffCanvas')
  
  // Add jQuery to Foundation
  Foundation.addToJquery(jQuery)

  // Kick off foundation
  jQuery(document).foundation()
}

// Start Foundation JS Modules
initFoundation();
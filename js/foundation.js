import jQuery from 'jquery';
import { Foundation } from 'foundation-sites/js/foundation.core'
import { Tabs } from 'foundation-sites/js/foundation.tabs'
import { AccordionMenu } from 'foundation-sites/js/foundation.accordionMenu'
import { DropdownMenu } from 'foundation-sites/js/foundation.dropdownMenu'
import { Drilldown } from 'foundation-sites/js/foundation.drilldown'
import { OffCanvas } from 'foundation-sites/js/foundation.offcanvas'
import { Sticky } from 'foundation-sites/js/foundation.sticky'
import { Equalizer } from 'foundation-sites/js/foundation.equalizer'
import { Reveal } from 'foundation-sites/js/foundation.reveal'

function initFoundation() {
  // Include the Foundation Modules that we'll use in the app
  Foundation.plugin(Tabs, 'Tabs')
  Foundation.plugin(AccordionMenu, 'AccordionMenu')
  Foundation.plugin(DropdownMenu, 'DropdownMenu')
  Foundation.plugin(Drilldown, 'Drilldown')
  Foundation.plugin(OffCanvas, 'OffCanvas')
  Foundation.plugin(Sticky, 'Sticky')
  Foundation.plugin(Equalizer, 'Equalizer')
  Foundation.plugin(Reveal, 'Reveal')
  
  // Add jQuery to Foundation
  Foundation.addToJquery(jQuery)

  // Kick off foundation
  jQuery(document).foundation()
}

// Start Foundation JS Modules
initFoundation();
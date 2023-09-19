require('./vmasker')

import Alpine from 'alpinejs'
window.Alpine = Alpine
import intersect from '@alpinejs/intersect'
import mask from '@alpinejs/mask'

Alpine.plugin(intersect)
Alpine.plugin(mask)
Alpine.start()

require('../support/swal')
require('../listeners/modal')

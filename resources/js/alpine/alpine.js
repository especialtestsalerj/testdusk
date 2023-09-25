require('./vmasker')

import Alpine from 'alpinejs'
window.Alpine = Alpine
import intersect from '@alpinejs/intersect'

Alpine.plugin(intersect)
Alpine.start()

require('../support/swal')
require('../listeners/modal')

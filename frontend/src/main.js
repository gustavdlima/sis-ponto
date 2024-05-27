
import App from './App.vue'
import "./style/style.css"
import { createApp, markRaw } from 'vue'
import router from './router/index.js'
import axios from 'axios'
import VueAxios from 'vue-axios'
import { createPinia } from 'pinia'
import { useAuthStore } from './stores/authStore'
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'
import PrimeVue from 'primevue/config'
import Lara from './presets/lara'
import Aura from './presets/aura'
import 'primeicons/primeicons.css'


import "bootstrap/dist/css/bootstrap.min.css"
import "bootstrap"

const pinia = createPinia()

const vuetify = createVuetify({
	components,
	directives
})

pinia.use(({ store }) => {
	store.$router = markRaw(router);
})

createApp(App)
.use(router)
.use(VueAxios, axios)
.use(pinia)
.use(vuetify)
.use(PrimeVue, {
	zIndex: {
        overlay: 1000,      //dropdown, multiselect
    },
	locale: { closeText: 'Fechar', prevText: 'Anterior', nextText: 'Próximo', currentText: 'Começo', monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'], monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun', 'Jul','Ago','Set','Out','Nov','Dez'], dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'], dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb'], dayNamesMin: ['D','S','T','Q','Q','S','S'], weekHeader: 'Semana', firstDay: 0, isRTL: false, showMonthAfterYear: false, yearSuffix: '', timeOnlyTitle: 'Só Horas', timeText: 'Tempo', hourText: 'Hora', minuteText: 'Minuto', secondText: 'Segundo', ampm: false, month: 'Mês', week: 'Semana', day: 'Dia', allDayText : 'Todo o Dia'
	},
	pt: Aura,
})
.mount('#app')

const authStore = useAuthStore();

router.beforeResolve((to) => {
	if (to.meta.requiresAuth && !authStore.userLogged) {
		return { path: '/login' }
	} else {
		return true
	}
})

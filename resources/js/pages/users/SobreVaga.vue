<script setup>
import { Head, router } from '@inertiajs/vue3'
import { onMounted } from 'vue'

const props = defineProps({
  vaga: {
    type: Object,
    required: true,
  },
})

/**
 * Carrega o SweetAlert2 via CDN
 */
onMounted(() => {
  if (!window.Swal) {
    const script = document.createElement('script')
    script.src = 'https://cdn.jsdelivr.net/npm/sweetalert2@11'
    script.async = true
    document.head.appendChild(script)
  }
})

/**
 * Voltar para página anterior
 */
const voltar = () => {
  window.history.back()
}

/**
 * Candidatar à vaga
 */
const candidatar = () => {
  router.post(
    '/user/cadastrarVaga',
    {
      companie_id: props.vaga.companie_id,
      vagas_id: props.vaga.vagas_id,
    },
    {
      onSuccess: () => {
        window.Swal.fire({
          icon: 'success',
          title: 'Candidatura realizada!',
          text: 'Você se candidatou à vaga com sucesso 🚀',
          confirmButtonColor: '#4f46e5',
        })
      },
      onError: () => {
        window.Swal.fire({
          icon: 'error',
          title: 'Ops...',
          text: 'Não foi possível se candidatar à vaga.',
          confirmButtonColor: '#ef4444',
        })
      },
    }
  )
}
</script>

<template>
  <Head :title="vaga.nome_vaga" />

  <div
    class="min-h-screen bg-gradient-to-br
           from-indigo-50 via-white to-indigo-100
           dark:from-[#0a0a0a] dark:via-[#111] dark:to-[#0a0a0a]
           text-[#1b1b18] dark:text-[#EDEDEC]"
  >


    <section class="mx-auto max-w-5xl px-6 pt-16">
      <div class="bg-white dark:bg-[#161615] rounded-2xl shadow p-8">

      <button
      @click="voltar"
      class="group inline-flex items-center gap-2
            mb-6
            rounded-full border
            border-indigo-200 dark:border-indigo-500/30
            bg-indigo-50 dark:bg-indigo-500/10
            px-4 py-2
            text-sm font-semibold
            text-indigo-700 dark:text-indigo-300
            transition-all duration-200
            hover:bg-indigo-100 dark:hover:bg-indigo-500/20
            hover:shadow-sm"
    >
      <span
        class="flex h-6 w-6 items-center justify-center
              rounded-full
              bg-indigo-600 text-white
              transition-transform duration-200
              group-hover:-translate-x-1"
      >
        ←
      </span>

      Voltar
    </button>
        <span
          class="inline-block mb-4 text-xs font-semibold
                 bg-indigo-100 dark:bg-indigo-500/10
                 text-indigo-700 dark:text-indigo-400
                 px-3 py-1 rounded-full"
        >
          {{ vaga.tipo_vaga }}
        </span>

        <h1 class="text-3xl font-extrabold mb-2">
          {{ vaga.nome_vaga }}
        </h1>

        <p class="text-gray-600 dark:text-gray-400 text-lg">
          {{ vaga.company?.nome_companie ?? 'Empresa não informada' }}
        </p>

      </div>
    </section>

    <section class="mx-auto max-w-5xl px-6 mt-10 grid gap-6 lg:grid-cols-3">

      <div class="lg:col-span-2 bg-white dark:bg-[#161615] rounded-2xl shadow p-8">

        <h2 class="text-xl font-bold mb-4">
          Sobre a vaga
        </h2>

        <p class="text-gray-700 dark:text-gray-300 leading-relaxed whitespace-pre-line">
          {{ vaga.desc_vaga }}
        </p>

      </div>

      <aside class="bg-white dark:bg-[#161615] rounded-2xl shadow p-6 space-y-6">

        <div>
          <p class="text-sm text-gray-500">Salário</p>
          <p class="font-semibold text-lg">
            R$ {{
              Number(vaga.salario_vaga).toLocaleString('pt-BR', {
                minimumFractionDigits: 2,
              })
            }}
          </p>
        </div>

        <div>
          <p class="text-sm text-gray-500">Área</p>
          <p class="font-medium">
            {{ vaga.area_vaga }}
          </p>
        </div>

        <div>
          <p class="text-sm text-gray-500">Tipo</p>
          <p class="font-medium">
            {{ vaga.tipo_vaga }}
          </p>
        </div>

        <button
          @click="candidatar"
          class="w-full mt-6 rounded-xl
                 bg-indigo-600 text-white
                 px-6 py-3 font-semibold
                 hover:bg-indigo-700 transition
                 dark:bg-indigo-500 dark:hover:bg-indigo-400 dark:text-black"
        >
          Candidatar-se
        </button>

      </aside>
    </section>

    <div class="h-20"></div>
  </div>
</template>

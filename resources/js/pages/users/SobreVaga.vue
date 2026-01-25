<script setup>
import { Head } from '@inertiajs/vue3'

const props = defineProps({
  vaga: {
    type: Object,
    required: true,
  },
})
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

<script setup lang="ts">
import { computed, ref } from 'vue'
import { usePage, Head, Link } from '@inertiajs/vue3'

interface Company {
  companie_id: number
  name_companie: string
}

interface Vaga {
  vagas_id: number
  nome_vaga: string
  desc_vaga: string
  salario_vaga: string
  local_vaga: string
  area_vaga: string
  tipo_vaga: string
  company?: Company | null
}

interface User {
  name: string
  email: string
}

const page = usePage()

const vagas = computed(() => {
  return (page.props.vagas ?? []) as Vaga[]
})

const user = computed(() => {
  return page.props.auth?.user as User | null
})

const search = ref('')
const tipo = ref('')

const vagasFiltradas = computed(() => {
  return vagas.value.filter(vaga => {
    const empresaNome = vaga.company?.name_companie ?? ''
    const textoBusca = `${vaga.nome_vaga} ${empresaNome}`.toLowerCase()

    const matchSearch = textoBusca.includes(search.value.toLowerCase())
    const matchTipo = tipo.value ? vaga.tipo_vaga === tipo.value : true

    return matchSearch && matchTipo
  })
})
</script>

<template>
  <Head title="Mais Vagas" />

  <div
    class="min-h-screen bg-gradient-to-br
           from-indigo-50 via-white to-indigo-100
           dark:from-[#0a0a0a] dark:via-[#111] dark:to-[#0a0a0a]
           text-[#1b1b18] dark:text-[#EDEDEC]"
  >

    <!-- PERFIL DO USUÁRIO -->
    <section class="mx-auto max-w-7xl px-6 pt-10">
      <div
        v-if="user"
        class="bg-white dark:bg-[#161615]
               rounded-2xl shadow
               p-5
               flex items-center justify-between
               gap-4"
      >
        <div class="flex items-center gap-4">
          <div
            class="w-12 h-12 rounded-full
                   bg-indigo-600
                   flex items-center justify-center
                   text-white font-bold text-lg"
          >
            {{ user.name.charAt(0) }}
          </div>

          <div>
            <p class="font-semibold leading-tight">
              {{ user.name }}
            </p>
            <p class="text-sm text-gray-500 dark:text-gray-400">
              {{ user.email }}
            </p>
          </div>
        </div>

        <Link
          href="../settings/profile"
          class="inline-flex items-center gap-2
                 rounded-xl
                 bg-indigo-600
                 px-5 py-2.5
                 text-sm font-semibold text-white
                 hover:bg-indigo-700 transition
                 dark:bg-indigo-500
                 dark:hover:bg-indigo-400
                 dark:text-black"
        >
          Meu perfil →
        </Link>
      </div>
    </section>

    <!-- HERO / FILTROS -->
    <section class="mx-auto max-w-7xl px-6 pt-16 pb-12">
      <h1 class="text-3xl lg:text-4xl font-extrabold mb-4">
        Encontre sua próxima
        <span class="text-indigo-600 dark:text-indigo-400">
          oportunidade
        </span>
      </h1>

      <p class="text-gray-600 dark:text-gray-400 mb-8 max-w-2xl">
        Explore vagas atualizadas, filtre por tipo de contrato e
        candidate-se em poucos cliques.
      </p>

      <div
        class="bg-white dark:bg-[#161615]
               rounded-xl p-4 shadow-lg
               flex flex-col lg:flex-row gap-4"
      >
        <input
          v-model="search"
          type="text"
          placeholder="Cargo ou empresa"
          class="flex-1 rounded-lg border
                 border-black/10 dark:border-white/10
                 px-4 py-3 bg-transparent"
        />

        <select
          v-model="tipo"
          class="rounded-lg border
                 border-black/10 dark:border-white/10
                 px-4 py-3 bg-transparent"
        >
          <option value="">Todos os tipos</option>
          <option value="CLT">CLT</option>
          <option value="PJ">PJ</option>
          <option value="Estagio">Estágio</option>
          <option value="Jovem aprendiz">Jovem Aprendiz</option>
        </select>
      </div>
    </section>

    <!-- LISTAGEM -->
    <section class="mx-auto max-w-7xl px-6 pb-20">
      <div class="grid gap-5">
        <article
          v-for="vaga in vagasFiltradas"
          :key="vaga.vagas_id"
          class="group bg-white dark:bg-[#161615]
                 rounded-xl p-6 shadow
                 hover:shadow-xl transition
                 flex gap-4"
        >
          <div
            class="w-12 h-12 rounded-lg
                   bg-indigo-100 dark:bg-indigo-500/10
                   flex items-center justify-center
                   font-bold text-indigo-600 dark:text-indigo-400"
          >
            {{ vaga.company?.name_companie?.charAt(0) ?? '?' }}
          </div>

          <div class="flex-1">
            <h2
              class="text-lg font-semibold
                     group-hover:text-indigo-600
                     dark:group-hover:text-indigo-400
                     transition"
            >
              {{ vaga.nome_vaga }}
            </h2>

            <p class="text-sm text-gray-600 dark:text-gray-400">
              {{ vaga.company?.name_companie ?? 'Empresa não informada' }}
              • {{ vaga.local_vaga }}
            </p>

            <p class="text-sm text-gray-500 mt-2">
              {{ vaga.desc_vaga }}
            </p>

            <span
              class="inline-block mt-3 text-xs font-medium
                     bg-indigo-100 dark:bg-indigo-500/10
                     text-indigo-700 dark:text-indigo-400
                     px-3 py-1 rounded-full"
            >
              {{ vaga.tipo_vaga }}
            </span>
          </div>

          <Link
            :href="`/user/sobreVaga/${vaga.vagas_id}`"
            class="self-center rounded-lg
                   border border-indigo-600
                   px-4 py-2 text-sm font-medium
                   text-indigo-600
                   hover:bg-indigo-600 hover:text-white
                   transition
                   dark:border-indigo-400
                   dark:text-indigo-400
                   dark:hover:bg-indigo-400
                   dark:hover:text-black"
          >
            Ver vaga
          </Link>
        </article>

        <div
          v-if="!vagasFiltradas.length"
          class="text-center text-gray-500 mt-12"
        >
          Nenhuma vaga encontrada 😕
        </div>
      </div>
    </section>
  </div>
</template>

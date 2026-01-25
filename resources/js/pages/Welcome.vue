<script setup lang="ts">
import { dashboard, login, register } from '@/routes'
import { Head, Link } from '@inertiajs/vue3'

withDefaults(
  defineProps<{
    canRegister: boolean
  }>(),
  {
    canRegister: true,
  },
)
</script>

<template>
  <Head title="Mais Vagas">
    <link rel="preconnect" href="https://rsms.me/" />
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
  </Head>

  <div class="min-h-screen bg-gradient-to-br from-indigo-50 via-white to-indigo-100 dark:from-[#0a0a0a] dark:via-[#111] dark:to-[#0a0a0a] text-[#1b1b18] dark:text-[#EDEDEC]">

    <!-- HEADER -->
    <header class="mx-auto max-w-7xl px-6 py-6 flex items-center justify-between">
      <h1 class="text-2xl font-bold tracking-tight">
        <span class="text-indigo-600 dark:text-indigo-400">Mais</span> Vagas
      </h1>

      <nav class="flex gap-3">
        <Link
          v-if="$page.props.auth.user"
          :href="dashboard()"
          class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700 transition"
        >
          Dashboard
        </Link>

        <template v-else>
          <Link
            :href="login()"
            class="rounded-md px-4 py-2 text-sm font-medium hover:bg-black/5 dark:hover:bg-white/10 transition"
          >
            Entrar
          </Link>

          <Link
            v-if="canRegister"
            :href="register()"
            class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700 transition"
          >
            Criar conta
          </Link>
        </template>
      </nav>
    </header>

    <!-- HERO -->
    <main class="mx-auto max-w-7xl px-6 py-24 grid lg:grid-cols-2 gap-16 items-center">

      <!-- TEXTO -->
      <section>
        <h2 class="text-4xl lg:text-5xl font-extrabold leading-tight mb-6">
          Conectando talentos às
          <span class="text-indigo-600 dark:text-indigo-400">
            melhores oportunidades
          </span>
        </h2>

        <p class="text-lg text-gray-600 dark:text-gray-400 mb-10 max-w-xl">
          O <strong>Mais Vagas</strong> é a plataforma ideal para encontrar empregos,
          divulgar oportunidades e acelerar contratações de forma simples e rápida.
        </p>

        <div class="flex flex-wrap gap-4">
          <Link
            :href="login()"
            class="rounded-lg bg-indigo-600 px-6 py-3 text-white font-medium hover:bg-indigo-700 transition"
          >
            🔍 Encontrar vagas
          </Link>

          <Link
            v-if="canRegister"
            href="#"
            class="rounded-lg border border-indigo-600 px-6 py-3 font-medium text-indigo-600 hover:bg-indigo-600 hover:text-white transition dark:border-indigo-400 dark:text-indigo-400 dark:hover:bg-indigo-400 dark:hover:text-black"
          >
            🏢 Cadastrar empresa
          </Link>
        </div>
      </section>

      <!-- CARDS -->
      <section class="grid gap-6 sm:grid-cols-2">
        <div class="rounded-xl bg-white dark:bg-[#161615] p-6 shadow-lg">
          <h3 class="text-lg font-semibold mb-2">📄 Vagas atualizadas</h3>
          <p class="text-sm text-gray-600 dark:text-gray-400">
            Encontre oportunidades novas todos os dias, em diversas áreas.
          </p>
        </div>

        <div class="rounded-xl bg-white dark:bg-[#161615] p-6 shadow-lg">
          <h3 class="text-lg font-semibold mb-2">⚡ Processo rápido</h3>
          <p class="text-sm text-gray-600 dark:text-gray-400">
            Candidate-se em poucos cliques, sem burocracia.
          </p>
        </div>

        <div class="rounded-xl bg-white dark:bg-[#161615] p-6 shadow-lg">
          <h3 class="text-lg font-semibold mb-2">🏢 Para empresas</h3>
          <p class="text-sm text-gray-600 dark:text-gray-400">
            Publique vagas e encontre talentos qualificados facilmente.
          </p>
        </div>

        <div class="rounded-xl bg-white dark:bg-[#161615] p-6 shadow-lg">
          <h3 class="text-lg font-semibold mb-2">🔒 Seguro e confiável</h3>
          <p class="text-sm text-gray-600 dark:text-gray-400">
            Seus dados protegidos com tecnologia moderna.
          </p>
        </div>
      </section>

    </main>

    <!-- FOOTER -->
    <footer class="border-t border-black/5 dark:border-white/10 py-6 text-center text-sm text-gray-500">
      © {{ new Date().getFullYear() }} Mais Vagas — Todos os direitos reservados
    </footer>

  </div>
</template>
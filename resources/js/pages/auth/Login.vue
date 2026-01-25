<script setup lang="ts">
import InputError from '@/components/InputError.vue'
import TextLink from '@/components/TextLink.vue'
import { Button } from '@/components/ui/button'
import { Checkbox } from '@/components/ui/checkbox'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import { Spinner } from '@/components/ui/spinner'
import AuthBase from '@/layouts/AuthLayout.vue'
import { register } from '@/routes'
import { store } from '@/routes/login'
import { request } from '@/routes/password'
import { Form, Head, usePage } from '@inertiajs/vue3'

const page = usePage()

defineProps<{
  status?: string
  canResetPassword: boolean
  canRegister: boolean
}>()
</script>

<template>
  <Head title="Entrar | Mais Vagas" />

  <AuthBase
    title="Bem-vindo de volta 👋"
    description="Acesse sua conta para encontrar ou gerenciar vagas"
  >
    <!-- STATUS -->
    <div
      v-if="status"
      class="mb-4 rounded-md bg-green-50 px-4 py-2 text-center text-sm font-medium text-green-700 dark:bg-green-900/20 dark:text-green-400"
    >
      {{ status }}
    </div>

    <!-- FORM -->
    <Form
      v-bind="store.form()"
      :reset-on-success="['password']"
      v-slot="{ errors, processing }"
      @finish="() => {
        if (page.props.auth?.user) {
          $inertia.visit('/user')
        }
      }"
      class="space-y-6"
    >
      <!-- EMAIL -->
      <div class="space-y-2">
        <Label for="email">Email</Label>
        <Input
          id="email"
          type="email"
          name="email"
          required
          autofocus
          autocomplete="email"
          placeholder="seu@email.com"
          class="h-11"
        />
        <InputError :message="errors.email" />
      </div>

      <!-- PASSWORD -->
      <div class="space-y-2">
        <div class="flex items-center justify-between">
          <Label for="password">Senha</Label>

          <TextLink
            v-if="canResetPassword"
            :href="request()"
            class="text-sm text-indigo-600 hover:text-indigo-700 dark:text-indigo-400"
          >
            Esqueci minha senha
          </TextLink>
        </div>

        <Input
          id="password"
          type="password"
          name="password"
          required
          autocomplete="current-password"
          placeholder="••••••••"
          class="h-11"
        />
        <InputError :message="errors.password" />
      </div>

      <!-- REMEMBER -->
      <div class="flex items-center justify-between">
        <Label for="remember" class="flex items-center gap-2 text-sm">
          <Checkbox id="remember" name="remember" />
          <span>Lembrar de mim</span>
        </Label>
      </div>

      <!-- BUTTON -->
      <Button
        type="submit"
        class="h-11 w-full bg-indigo-600 text-white hover:bg-indigo-700 transition"
        :disabled="processing"
        data-test="login-button"
      >
        <Spinner v-if="processing" />
        <span v-else>Entrar</span>
      </Button>

      <!-- REGISTER -->
      <div
        v-if="canRegister"
        class="text-center text-sm text-muted-foreground"
      >
        Ainda não tem conta?
        <TextLink
          :href="register()"
          class="font-medium text-indigo-600 hover:text-indigo-700 dark:text-indigo-400"
        >
          Criar conta
        </TextLink>
      </div>
    </Form>
  </AuthBase>
</template>

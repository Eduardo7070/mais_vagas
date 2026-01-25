<script setup lang="ts">
import InputError from '@/components/InputError.vue'
import TextLink from '@/components/TextLink.vue'
import { Button } from '@/components/ui/button'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import { Spinner } from '@/components/ui/spinner'
import AuthBase from '@/layouts/AuthLayout.vue'
import { login } from '@/routes'
import { store } from '@/routes/register'
import { Form, Head } from '@inertiajs/vue3'
</script>

<template>
  <Head title="Criar conta | Mais Vagas" />

  <AuthBase
    title="Crie sua conta 🚀"
    description="Leva menos de um minuto para começar no Mais Vagas"
  >
    <Form
      v-bind="store.form()"
      :reset-on-success="['password', 'password_confirmation']"
      v-slot="{ errors, processing }"
      class="space-y-6"
    >

      <div class="space-y-2">
        <Label for="name">Nome completo</Label>
        <Input
          id="name"
          type="text"
          name="name"
          required
          autofocus
          autocomplete="name"
          placeholder="Seu nome completo"
          class="h-11"
        />
        <InputError :message="errors.name" />
      </div>

      <div class="space-y-2">
        <Label for="email">Email</Label>
        <Input
          id="email"
          type="email"
          name="email"
          required
          autocomplete="email"
          placeholder="seu@email.com"
          class="h-11"
        />
        <InputError :message="errors.email" />
      </div>

      <div class="space-y-2">
        <Label for="password">Senha</Label>
        <Input
          id="password"
          type="password"
          name="password"
          required
          autocomplete="new-password"
          placeholder="••••••••"
          class="h-11"
        />
        <InputError :message="errors.password" />
      </div>

      <div class="space-y-2">
        <Label for="password_confirmation">Confirmar senha</Label>
        <Input
          id="password_confirmation"
          type="password"
          name="password_confirmation"
          required
          autocomplete="new-password"
          placeholder="••••••••"
          class="h-11"
        />
        <InputError :message="errors.password_confirmation" />
      </div>

      <Button
        type="submit"
        class="h-11 w-full bg-indigo-600 text-white hover:bg-indigo-700 transition"
        :disabled="processing"
        data-test="register-user-button"
      >
        <Spinner v-if="processing" />
        <span v-else>Criar conta</span>
      </Button>

      <div class="text-center text-sm text-muted-foreground">
        Já tem uma conta?
        <TextLink
          :href="login()"
          class="font-medium text-indigo-600 hover:text-indigo-700 dark:text-indigo-400"
        >
          Entrar
        </TextLink>
      </div>
    </Form>
  </AuthBase>
</template>

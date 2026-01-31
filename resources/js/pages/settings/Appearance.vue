<script setup lang="ts">
import { useForm } from '@inertiajs/vue3'
import Heading from '@/components/Heading.vue'
import { Button } from '@/components/ui/button'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import SettingsLayout from '@/layouts/settings/Layout.vue'
import { Head } from '@inertiajs/vue3'

const form = useForm({
    cargo_desejado: '',
    resumo_profissional: '',

    experiencias: [
        {
            cargo: '',
            empresa: '',
            periodo: '',
            descricao: '',
        }
    ],

    formacoes: [
        {
            curso: '',
            instituicao: '',
            periodo: '',
        }
    ]
})

const adicionarExperiencia = () => {
    form.experiencias.push({
        cargo: '',
        empresa: '',
        periodo: '',
        descricao: '',
    })
}

const removerExperiencia = (index: number) => {
    form.experiencias.splice(index, 1)
}

const adicionarFormacao = () => {
    form.formacoes.push({
        curso: '',
        instituicao: '',
        periodo: '',
    })
}

const removerFormacao = (index: number) => {
    form.formacoes.splice(index, 1)
}

const salvarCurriculo = () => {
    form.post('/curriculo', {
        preserveScroll: true,

        onSuccess: () => {
            alert('Currículo criado!')
            form.reset()
        }
    })
}
</script>

<template>

    <Head title="Meu Currículo" />

    <SettingsLayout>
        <div class="space-y-10">

            <div class="rounded-2xl p-6 bg-gradient-to-br from-indigo-600 to-indigo-500 text-white shadow-lg">
                <h2 class="text-2xl font-bold mb-2">
                    Crie seu currículo profissional
                </h2>
            </div>

            <div class="bg-white dark:bg-[#161615] rounded-2xl p-8 shadow space-y-10">

                <Heading variant="small" title="Informações profissionais" />

                <!-- CARGO -->
                <div class="grid gap-2">
                    <Label>Cargo desejado</Label>
                    <Input v-model="form.cargo_desejado" />

                    <div v-if="form.errors.cargo_desejado" class="text-red-500 text-sm">
                        {{ form.errors.cargo_desejado }}
                    </div>
                </div>

                <!-- RESUMO -->
                <div class="grid gap-2">
                    <Label>Resumo profissional</Label>
                    <textarea v-model="form.resumo_profissional" class="rounded-lg border px-4 py-3" />

                    <div v-if="form.errors.resumo_profissional" class="text-red-500 text-sm">
                        {{ form.errors.resumo_profissional }}
                    </div>
                </div>

                <!-- EXPERIÊNCIAS -->
                <div class="space-y-4">

                    <div class="flex justify-between">
                        <h3 class="font-semibold text-lg">
                            Experiência profissional
                        </h3>

                        <Button @click="adicionarExperiencia">
                            + Adicionar
                        </Button>
                    </div>

                    <div v-for="(exp, index) in form.experiencias" :key="index" class="border p-4 rounded-xl space-y-3">

                        <div class="grid md:grid-cols-2 gap-3">
                            <Input v-model="exp.cargo" placeholder="Cargo" />
                            <Input v-model="exp.empresa" placeholder="Empresa" />
                        </div>

                        <Input v-model="exp.periodo" placeholder="Período" />

                        <textarea v-model="exp.descricao" class="w-full border rounded-lg px-4 py-3" />

                        <Button v-if="form.experiencias.length > 1" @click="removerExperiencia(index)"
                            variant="destructive">
                            Remover
                        </Button>

                    </div>
                </div>

                <!-- FORMAÇÕES -->
                <div class="space-y-4">

                    <div class="flex justify-between">
                        <h3 class="font-semibold text-lg">
                            Formação acadêmica
                        </h3>

                        <Button @click="adicionarFormacao">
                            + Adicionar
                        </Button>
                    </div>

                    <div v-for="(formacao, index) in form.formacoes" :key="index"
                        class="border p-4 rounded-xl space-y-3">

                        <div class="grid md:grid-cols-2 gap-3">
                            <Input v-model="formacao.curso" placeholder="Curso" />
                            <Input v-model="formacao.instituicao" placeholder="Instituição" />
                        </div>

                        <Input v-model="formacao.periodo" placeholder="Período" />

                        <Button v-if="form.formacoes.length > 1" @click="removerFormacao(index)" variant="destructive">
                            Remover
                        </Button>

                    </div>
                </div>

                <div class="flex justify-end">
                    <Button @click="salvarCurriculo" :disabled="form.processing">
                        {{ form.processing ? 'Salvando...' : 'Salvar currículo' }}
                    </Button>
                </div>

            </div>
        </div>
    </SettingsLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
  statuses: {
    type: Array,
    default: () => [],
  },
  users: {
    type: Array,
    default: () => [],
  },
});

const form = useForm({
  title: '',
  description: '',
  status_id: props.statuses[0]?.id ?? '',
  user_id: '',
  due_date: '',
});

function submit() {
  form.post(route('tasks.store'));
}
</script>

<template>
  <Head title="Créer une tâche" />

  <AuthenticatedLayout>
    <template #header>
      <div class="flex items-center justify-between">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
          Créer une tâche
        </h2>

        <Link
          :href="route('tasks.index')"
          class="text-sm text-indigo-600 hover:underline"
        >
          ← Retour à la liste
        </Link>
      </div>
    </template>

    <div class="py-12">
      <div class="mx-auto max-w-3xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white">
            <form @submit.prevent="submit" class="space-y-4">
              <!-- Titre -->
              <div>
                <label class="block text-sm font-medium text-gray-700">
                  Titre
                </label>
                <input
                  v-model="form.title"
                  type="text"
                  class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                />
                <p v-if="form.errors.title" class="mt-1 text-sm text-red-600">
                  {{ form.errors.title }}
                </p>
              </div>

              <!-- Description -->
              <div>
                <label class="block text-sm font-medium text-gray-700">
                  Description
                </label>
                <textarea
                  v-model="form.description"
                  rows="3"
                  class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                />
                <p v-if="form.errors.description" class="mt-1 text-sm text-red-600">
                  {{ form.errors.description }}
                </p>
              </div>

              <!-- Statut -->
              <div>
                <label class="block text-sm font-medium text-gray-700">
                  Statut
                </label>
                <select
                  v-model="form.status_id"
                  class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                >
                  <option disabled value="">Sélectionner un statut</option>
                  <option
                    v-for="status in props.statuses"
                    :key="status.id"
                    :value="status.id"
                  >
                    {{ status.name }}
                  </option>
                </select>
                <p v-if="form.errors.status_id" class="mt-1 text-sm text-red-600">
                  {{ form.errors.status_id }}
                </p>
              </div>

              <!-- Assigné à (liste des users) -->
              <div>
                <label class="block text-sm font-medium text-gray-700">
                  Assigné à
                </label>
                <select
                  v-model="form.user_id"
                  class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                >
                  <option value="">Moi (utilisateur connecté)</option>
                  <option
                    v-for="user in props.users"
                    :key="user.id"
                    :value="user.id"
                  >
                    {{ user.name }}
                  </option>
                </select>
                <p v-if="form.errors.user_id" class="mt-1 text-sm text-red-600">
                  {{ form.errors.user_id }}
                </p>
              </div>

              <!-- Échéance -->
              <div>
                <label class="block text-sm font-medium text-gray-700">
                  Échéance
                </label>
                <input
                  v-model="form.due_date"
                  type="date"
                  class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                />
                <p v-if="form.errors.due_date" class="mt-1 text-sm text-red-600">
                  {{ form.errors.due_date }}
                </p>
              </div>

              <!-- Bouton -->
              <div class="pt-4">
                <button
                  type="submit"
                  class="inline-flex items-center px-4 py-2 rounded bg-indigo-600 text-white text-sm font-semibold hover:bg-indigo-700 focus:outline-none focus:ring focus:ring-indigo-300"
                  :disabled="form.processing"
                >
                  Créer la tâche
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

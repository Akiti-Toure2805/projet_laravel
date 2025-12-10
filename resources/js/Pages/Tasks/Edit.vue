<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

const props = defineProps({
  task: {
    type: Object,
    required: true,
  },
  statuses: {
    type: Array,
    required: true,
  },
  users: {
    type: Array,
    required: true,
  },
});

// Formulaire pré-rempli avec les valeurs de la tâche
const form = useForm({
  title: props.task.title || "",
  description: props.task.description || "",
  status_id: props.task.status_id || "",
  user_id: props.task.user_id || "",
  due_date: props.task.due_date || "",
});

const submit = () => {
  form.put(`/tasks/${props.task.id}`);
};
</script>

<template>
  <AuthenticatedLayout>
    <Head title="Modifier une tâche" />

    <!-- Header comme sur la page Dashboard/Create -->
    <template #header>
      <div class="flex items-center justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Modifier une tâche
        </h2>

        <Link
          href="/tasks"
          class="text-sm text-indigo-600 hover:text-indigo-800 hover:underline"
        >
          ← Retour à la liste
        </Link>
      </div>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900 max-w-2xl mx-auto">
            <form @submit.prevent="submit" class="space-y-6">
              <!-- Titre -->
              <div>
                <label class="block font-medium text-sm text-gray-700"> Titre </label>
                <input
                  v-model="form.title"
                  type="text"
                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                />
                <p v-if="form.errors.title" class="mt-1 text-xs text-red-600">
                  {{ form.errors.title }}
                </p>
              </div>

              <!-- Description -->
              <div>
                <label class="block font-medium text-sm text-gray-700">
                  Description
                </label>
                <textarea
                  v-model="form.description"
                  rows="4"
                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                ></textarea>
                <p v-if="form.errors.description" class="mt-1 text-xs text-red-600">
                  {{ form.errors.description }}
                </p>
              </div>

              <!-- Statut -->
              <div>
                <label class="block font-medium text-sm text-gray-700"> Statut </label>
                <select
                  v-model="form.status_id"
                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                >
                  <option value="">Choisir un statut</option>
                  <option v-for="status in statuses" :key="status.id" :value="status.id">
                    {{ status.name }}
                  </option>
                </select>
                <p v-if="form.errors.status_id" class="mt-1 text-xs text-red-600">
                  {{ form.errors.status_id }}
                </p>
              </div>

              <!-- Assigné à -->
              <div>
                <label class="block font-medium text-sm text-gray-700"> Assigné à </label>
                <select
                  v-model="form.user_id"
                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                >
                  <option value="">Choisir un utilisateur</option>
                  <option v-for="user in users" :key="user.id" :value="user.id">
                    {{ user.name }}
                  </option>
                </select>
                <p v-if="form.errors.user_id" class="mt-1 text-xs text-red-600">
                  {{ form.errors.user_id }}
                </p>
              </div>

              <!-- Échéance -->
              <div>
                <label class="block font-medium text-sm text-gray-700"> Échéance </label>
                <input
                  v-model="form.due_date"
                  type="date"
                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                />
                <p v-if="form.errors.due_date" class="mt-1 text-xs text-red-600">
                  {{ form.errors.due_date }}
                </p>
              </div>

              <!-- Boutons -->
              <div class="flex items-center justify-end space-x-3">
                <Link
                  href="/tasks"
                  class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md text-sm text-gray-700 bg-white hover:bg-gray-50"
                >
                  Annuler
                </Link>

                <button
                  type="submit"
                  class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50"
                  :disabled="form.processing"
                >
                  Enregistrer les modifications
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

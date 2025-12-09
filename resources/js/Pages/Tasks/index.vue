<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    tasks: Array
});
</script>


<template>
  <div class="p-6">
    <div class="flex items-center justify-between mb-4">
      <h1 class="text-2xl font-bold">Liste des tâches</h1>

      <Link
        href="/tasks/create"
        class="inline-flex items-center px-4 py-2 rounded bg-indigo-600 text-white text-sm font-semibold hover:bg-indigo-700 focus:outline-none focus:ring focus:ring-indigo-300"
      >
        + Ajouter une tâche
      </Link>
    </div>

    <div class="bg-white shadow rounded-lg p-4">
      <!-- ton tableau reste pareil ici -->
      <table class="w-full border-collapse">
        <thead>
          <tr class="bg-gray-100">
            <th class="p-2 text-left">Titre</th>
            <th class="p-2 text-left">Statut</th>
            <th class="p-2 text-left">Assigné à</th>
            <th class="p-2 text-left">Échéance</th>
            <th class="p-2 text-left">Actions</th>
          </tr>
        </thead>

        <tbody>
          <tr v-for="task in tasks" :key="task.id" class="border-b">
            <td class="p-2">{{ task.title }}</td>

            <td class="p-2">
              <span
                class="px-2 py-1 rounded text-white text-xs"
                :style="{ background: task.status.color }"
              >
                {{ task.status.name }}
              </span>
            </td>

            <td class="p-2">{{ task.user.name }}</td>

            <td class="p-2">
              {{ task.due_date ?? 'Aucune' }}
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

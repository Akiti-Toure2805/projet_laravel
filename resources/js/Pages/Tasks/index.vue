<script setup>
defineProps({
    tasks: Array
});
</script>

<template>
  <div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Liste des tâches</h1>

    <div class="bg-white shadow rounded-lg p-4">
      <table class="w-full border-collapse">
        <thead>
          <tr class="bg-gray-100">
            <th class="p-2 text-left">Titre</th>
            <th class="p-2 text-left">Statut</th>
            <th class="p-2 text-left">Assigné à</th>
            <th class="p-2 text-left">Échéance</th>
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

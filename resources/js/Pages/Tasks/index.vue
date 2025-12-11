<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Link, router, usePage } from "@inertiajs/vue3";

const props = defineProps({
  tasks: Array,
  statuses: Array,
});

const page = usePage();

const handleDelete = (id) => {
  if (confirm("Supprimer cette tâche ?")) {
    router.delete(`/tasks/${id}`);
  }
};

const handleStatusChange = (task, event) => {
  const newStatusId = event.target.value;

  router.patch(
    `/tasks/${task.id}/status`,
    { status_id: newStatusId },
    {
      preserveScroll: true,
    }
  );
};
</script>

<template>
  <Head title="Liste des tâches" />

  <AuthenticatedLayout>
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
        <table class="w-full border-collapse">
          <thead>
            <tr class="bg-gray-100">
              <th class="p-2 text-left">Titre</th>
              <th class="p-2 text-left">Description</th>
              <th class="p-2 text-left">Statut</th>
              <th class="p-2 text-left">Assigné à</th>
              <th class="p-2 text-left">Échéance</th>
              <th class="p-2 text-left">Actions</th>
            </tr>
          </thead>

          <tbody>
            <tr v-for="task in tasks" :key="task.id" class="border-b">
              <td class="p-2">{{ task.title }}</td>

              <td class="p-2">{{ task.description }}</td>

              <td class="p-2">
                <select
                  class="text-xs px-2 py-1 rounded text-white border-0 cursor-pointer"
                  :style="{ background: task.status?.color || '#6b7280' }"
                  :value="task.status_id"
                  @change="(e) => handleStatusChange(task, e)"
                  title="Changer le statut"
                >
                  <option v-for="status in statuses" :key="status.id" :value="status.id">
                    {{ status.name }}
                  </option>
                </select>
              </td>

              <td class="p-2">{{ task.user.name }}</td>

              <td class="p-2">
                {{ task.due_date ?? "Aucune" }}
              </td>

              <!-- ✅ Actions -->
              <td class="p-2 space-x-2">
                <Link
                  :href="`/tasks/${task.id}/edit`"
                  class="inline-flex items-center px-3 py-1 rounded bg-blue-600 text-white text-xs font-semibold hover:bg-blue-700"
                >
                  Modifier
                </Link>

                <button
                  type="button"
                  class="inline-flex items-center px-3 py-1 rounded bg-red-600 text-white text-xs font-semibold hover:bg-red-700"
                  @click="handleDelete(task.id)"
                >
                  Supprimer
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

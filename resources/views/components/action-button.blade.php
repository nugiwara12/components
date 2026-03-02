<script>
    function actionButton(onClick, title, iconClass, colorClass) {
        return `
            <button onclick="${onClick}"
                class="border border-gray-300 bg-white p-2 rounded-lg transition duration-200 flex items-center justify-center w-10 h-10 ${colorClass}"
                title="${title}">
                <i class="${iconClass}"></i>
            </button>
        `;
    }
</script>

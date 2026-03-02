<script>
    function renderPagination({
        current_page,
        last_page,
        per_page = 10,
        total = 0,
        onPageChange,
        containerId = 'pagination'
    }) {
        const container = document.getElementById(containerId);
        if (!container || typeof onPageChange !== 'function') return;

        container.innerHTML = '';

        // --- Wrapper ---
        const wrapper = document.createElement('div');
        wrapper.classList.add(
            'flex', 'flex-col', 'md:flex-row',
            'items-center', 'justify-between',
            'mt-4', 'space-y-2', 'md:space-y-0',
            'px-4', 'py-2', 'bg-white',
            'rounded-md', 'shadow-sm'
        );

        // --- LEFT: Show entries ---
        const leftDiv = document.createElement('div');
        leftDiv.classList.add('flex', 'items-center', 'space-x-2', 'text-gray-600', 'min-w-[200px]');

        const label = document.createElement('span');
        label.innerText = 'Show';

        const select = document.createElement('select');
        select.classList.add(
            'border', 'rounded-md', 'py-[2px]',
            'focus:outline-none', 'focus:ring-1',
            'focus:ring-gray-600'
        );

        [10, 25, 50, 100].forEach(n => {
            const option = document.createElement('option');
            option.value = n;
            option.innerText = n;
            if (n === per_page) option.selected = true;
            select.appendChild(option);
        });

        select.onchange = () => onPageChange(1, parseInt(select.value));

        const entriesText = document.createElement('span');
        entriesText.innerText = `of ${total} entries`;

        leftDiv.append(label, select, entriesText);

        // --- RIGHT: Pagination buttons ---
        const rightDiv = document.createElement('div');
        rightDiv.classList.add('flex', 'items-center', 'space-x-1', 'flex-wrap');

        // Previous
        const prevBtn = document.createElement('button');
        prevBtn.innerText = 'Previous';
        prevBtn.className = `px-3 py-1 border rounded-md hover:bg-gray-100 ${
            current_page === 1 ? 'opacity-50 cursor-not-allowed' : ''
        }`;
        if (current_page > 1) {
            prevBtn.onclick = () => onPageChange(current_page - 1, per_page);
        }
        rightDiv.appendChild(prevBtn);

        // Page numbers (windowed)
        const maxPagesToShow = 5;
        let startPage = Math.max(current_page - Math.floor(maxPagesToShow / 2), 1);
        let endPage = startPage + maxPagesToShow - 1;

        if (endPage > last_page) {
            endPage = last_page;
            startPage = Math.max(endPage - maxPagesToShow + 1, 1);
        }

        for (let i = startPage; i <= endPage; i++) {
            const btn = document.createElement('button');
            btn.innerText = i;
            btn.className = `px-3 py-1 border rounded-md ${
                i === current_page ? 'bg-gray-800 text-white' : 'hover:bg-gray-100'
            }`;
            btn.onclick = () => onPageChange(i, per_page);
            rightDiv.appendChild(btn);
        }

        // Next
        const nextBtn = document.createElement('button');
        nextBtn.innerText = 'Next';
        nextBtn.className = `px-3 py-1 border rounded-md hover:bg-gray-100 ${
            current_page === last_page ? 'opacity-50 cursor-not-allowed' : ''
        }`;
        if (current_page < last_page) {
            nextBtn.onclick = () => onPageChange(current_page + 1, per_page);
        }
        rightDiv.appendChild(nextBtn);

        wrapper.append(leftDiv, rightDiv);
        container.appendChild(wrapper);
    }
</script>

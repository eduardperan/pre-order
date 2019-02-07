"use strict"
class SubItem{
    constructor(category_id, category_name, items){
        this.category_id = category_id;
        this.category_name = category_name;
        this.items = items;

        let category = `   
            <span class="item-title">#${this.category_id + ' ' + this.category_name}</span>
            <div id="items-container-${this.category_id}">
                <!-- items will appear here -->
            </div>               
        `;
        let cat = document.createElement('div');
        cat.setAttribute('id', this.category_id);
        cat.classList.add('category');
        cat.innerHTML = category;
        document.getElementById('categories-container').append(cat);

        this.items.forEach(item => {
            this.addItem(item.id, item.name);
        });
         
    }

    addItem(itemid, name){
        let item = `
            <input type="checkbox" value="${itemid}"> ${name}<br>
        `;

        let it = document.createElement('div');
        it.setAttribute('id', itemid);
        it.classList.add('item');
        it.innerHTML = item;
        document.getElementById(`items-container-${this.category_id}`).append(it);
    }

}
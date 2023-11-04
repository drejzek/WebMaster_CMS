var i = 1;
function AddRow(){
    var fields = document.querySelector('#fields');
    var row = document.createElement('tr');
    var numcell = document.createElement('td');
    var titlecell = document.createElement('td');
    var typecell = document.createElement('td');
    var mamecell = document.createElement('td');
    var placeholdercell = document.createElement('td');
    var requiredcell = document.createElement('td');

    var title = document.createElement('input');
    title.type = "text";
    title.name = "title[]";
    title.className = "form-control";

    var type = document.createElement('select');
    type.name = "type[]";

    var o = document.createElement('option');
    o.textContent = "";
    o.value = 1;
    var o1 = document.createElement('option');
    o1.textContent = "Text";
    o1.value = 1;
    var o2 = document.createElement('option');
    o2.textContent = "E-mail";
    o2.value = 2;
    var o3 = document.createElement('option');
    o3.textContent = "Heslo";
    o3.value = 3;
    var o4 = document.createElement('option');
    o4.textContent = "Ćíslo";
    o4.value = 4;
    var o5 = document.createElement('option');
    o5.textContent = "Telefonní číslo";
    o5.value = 5;
    var o6 = document.createElement('option');
    o6.textContent = "Barva";
    o6.value = 6;
    var o7 = document.createElement('option');
    o7.textContent = "Rozsah";
    o7.value = 7;

    type.appendChild(o);
    type.appendChild(o1);
    type.appendChild(o2);
    type.appendChild(o3);
    type.appendChild(o4);
    type.appendChild(o5);
    type.appendChild(o6);
    type.appendChild(o7);

    var name = document.createElement('input');
    name.type = "text";
    name.name = "name[]";
    name.className = "form-control";

    var placeholder = document.createElement('input');
    placeholder.type = "text";
    placeholder.name = "placeholder[]";
    placeholder.className = "form-control";

    var required = document.createElement('input');
    required.type = "checkbox";
    required.name = "required[]";
    required.className = "form-check";

    titlecell.appendChild(title);
    typecell.appendChild(type);
    mamecell.appendChild(name);
    placeholdercell.appendChild(placeholder);
    requiredcell.appendChild(required);
    row.appendChild(titlecell);
    row.appendChild(typecell);
    row.appendChild(mamecell);
    row.appendChild(placeholdercell);
    row.appendChild(requiredcell);
    fields.appendChild(row);
}
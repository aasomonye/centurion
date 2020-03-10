(function(){

    var rowid = 0;
    // get modal options
    var modaloptions = document.querySelector('.modal-options');

    function checkbox(dom)
    {
        // manage checkbox triggers
        let checkboxtrigger = dom.querySelectorAll('*[data-checkbox-trigger]');

        if (checkboxtrigger.length > 0)
        {
            [].forEach.call(checkboxtrigger, function(element)
            {
                // get parent trigger 
                let parentTrigger = dom.querySelector('.'+element.getAttribute('data-parent-trigger'));
                parentTrigger = parentTrigger === null ? document : parentTrigger;

                // get all children
                let checkboxchild = parentTrigger.querySelectorAll('*[data-checkbox-child="'+element.getAttribute('data-checkbox-trigger')+'"]');

                element.addEventListener('change', function(){
                    if (checkboxchild.length > 0 && !element.hasAttribute('data-pause'))
                    {
                        element.removeAttribute('checked');

                        [].forEach.call(checkboxchild, function(child){
                            child.click();
                        });
                        

                        if (element.checked === false)
                        {
                            [].forEach.call(checkboxchild, function(child){
                                if (child.checked)
                                {
                                    child.click();
                                }
                            });
                        }
                    }
                });

                if (checkboxchild.length > 0)
                {
                    [].forEach.call(checkboxchild, function(child){
                        child.addEventListener('change', function(){
                            // parent hasn't been clicked?
                            var parent = parentTrigger.querySelector('*[data-checkbox-trigger="'+child.getAttribute('data-checkbox-child')+'"]');
                            if (parent != null)
                            {
                                if (parent.checked === false && child.checked === true)
                                {
                                    parent.setAttribute('data-pause', true);
                                    // click now
                                    parent.click();
                                    parent.removeAttribute('data-pause');
                                }
                                else
                                {
                                    var noclicks = [];

                                    // check childs
                                    [].forEach.call(checkboxchild, function(children){
                                        if (children.checked == false)
                                        {
                                            noclicks.push(1);
                                        }
                                    });

                                    if (noclicks.length == checkboxchild.length)
                                    {
                                        parent.setAttribute('data-pause', true);
                                        // click now
                                        parent.click();
                                        parent.removeAttribute('data-pause');
                                    }
                                }
                            }
                        });
                    });
                }
            });
        }
    }

    function manageFileUpload(target)
    {
        $(function(){

            if (typeof FileUploadWithPreview != 'undefined')
            {
                let images = (typeof phpvars != 'undefined' && typeof phpvars.images != 'undefined') ? phpvars.images : [];

                const upload = new FileUploadWithPreview(target, {
                    showDeleteButtonOnImages: true,
                    text: {
                        chooseFile: 'Please select from your photo library',
                        browse: 'Browse for images',
                        selectedCount: 'Total images',
                    },
                    presetFiles : images
                });

                if (images.length > 0)
                {
                    window.addEventListener('fileUploadWithPreview:imageDeleted', function(e) {
                        var cached = e.detail.cachedFileArray;
                        var newArray = [];
                        cached.forEach(function(blob){
                            newArray.push(blob.name);
                        });
                        var propertyimagecopy = document.querySelector('*[name="property_images_copy"]');
                        if (propertyimagecopy != null)
                        {
                            propertyimagecopy.value = newArray.join(',');
                        }
                    })
                }
            }
            
          
        });
    }

    let autoloadTableRows = function(parentTarget)
    {   
        // create a new row
        let trRow = document.createElement('tr');

        // create table data
        var td;
        let input = function(name, type = 'text'){ 
            var inputElement= document.createElement('input'); 
            inputElement.className = 'form-control'; 
            inputElement.type = type;
            inputElement.name = name + '[]';
            inputElement.setAttribute('required', 'yes');
            return inputElement;
        }; 
        // create entries
        let trash, roomtype, sleeps, price, totalrooms, description, modal;

        // trash
        trash = document.createElement('a');
        trash.href = 'javascript:void(0)';
        trash.className = 'text text-danger';
        trash.innerHTML = '<i class="fa fa-trash-alt"></i>';
        td = document.createElement('td');
        td.appendChild(trash);

        // add to tr
        trRow.appendChild(td);

        // room type
        roomtype = input('property_room_title');
        roomtype.placeholder = 'eg. deluxe king room'
        td = document.createElement('td');
        td.appendChild(roomtype);
        trRow.appendChild(td);

        // sleeps
        sleeps = input('sleeps', 'number');
        sleeps.value = 2;
        td = document.createElement('td');
        td.appendChild(sleeps);
        trRow.appendChild(td);

        // price
        price = input('room_price', 'number');
        td = document.createElement('td');

        // build amount wrapper
        var div = document.createElement('div');
        div.className = 'input-group';
        div.innerHTML = '<div class="input-group-prepend">\
        <span class="input-group-text">₦</span>\
        </div>';
        price.placeholder = 'Room Rate'
        div.appendChild(price);
        div2 = document.createElement('div');
        div2.className = 'input-group-append';
        div2.innerHTML = '<span class="input-group-text">.00</span>';
        div.appendChild(div2);

        td.appendChild(div);
        trRow.appendChild(td);

        // totalrooms
        totalrooms = input('total_rooms', 'number');
        totalrooms.value = 1;
        td = document.createElement('td');
        td.appendChild(totalrooms);
        trRow.appendChild(td);

        // modal
        modal = document.createElement('div');
        modal.className = 'modal fade';
        modal.id = 'modal-room-'+rowid;
        if (typeof phpvars != 'undefined' && modaloptions != null)
        {
            modal.innerHTML = phpvars.modalText;
            modal.querySelector('.modal-body').innerHTML = modaloptions.innerHTML;
            modal.querySelector('.modal-body').id = 'add-scroll';
        }

        // add index
        var modalAddIndex = modal.querySelectorAll('*[data-add-index]');
        if (modalAddIndex.length > 0)
        {
            [].forEach.call(modalAddIndex, function(addindexelement)
            {
                // get attr
                let attr = addindexelement.getAttribute('data-add-index');
                addindexelement.removeAttribute('data-add-index');
                let elemAttr = addindexelement.getAttribute(attr);
                addindexelement.setAttribute(attr, elemAttr + 'id' + rowid);

                if (addindexelement.hasAttribute('data-toggle'))
                {
                    var hf = addindexelement.getAttribute('href');
                    addindexelement.setAttribute('href', hf + 'id' + rowid);
                }

                if (addindexelement.hasAttribute('data-parent-trigger'))
                {
                    addindexelement.setAttribute('data-parent-trigger', addindexelement.getAttribute('data-parent-trigger') + 'id' + rowid);
                }
            });
        }

        // add data-add-rowid="true"
        var addrowidToNames = modal.querySelectorAll('*[data-add-rowid="true"]');
        if (addrowidToNames.length > 0)
        {
            [].forEach.call(addrowidToNames, function(element)
            {
                // get the input name
                let name = element.name;
                // replace name with name[rowid]
                name = name.replace('room[', 'room['+rowid+'][');
                name = name.replace('room_images[', 'room_images['+rowid+'][');
                name = name.replace('room_number[', 'room_number['+rowid+'][');
                element.name = name;
            });
        }

        // get data-upload-id="myUniqueUploadId"
        let uploadid = modal.querySelector('*[data-upload-id="myUniqueUploadId"]');
        if (uploadid !== null)
        {
            // get attribute
            let uploadAttr = uploadid.getAttribute('data-upload-id');
            // add row id
            uploadAttr = uploadAttr + rowid;
            // set id
            uploadid.setAttribute('data-upload-id', uploadAttr);
            // call manage file upload
            manageFileUpload(uploadAttr);
        }
        // description
        /*
        description = document.createElement('textarea');
        description.className = 'form-control';
        description.setAttribute('required', 'yes');
        description.name = 'property_room_info[]';
        description.placeholder = 'A brief information about this room';
        */
        description = document.createElement('span');
        description.className = 'expand-more-information';
        description.setAttribute('data-toggle', 'modal');
        description.setAttribute('data-target', '#modal-room-'+rowid);
        description.innerHTML = '<i class="fa fa-info-circle"></i> more information';
        td = document.createElement('td');
        td.appendChild(description);
        td.appendChild(modal);
        trRow.appendChild(td);

        // autoload rooms on system start
        let tableBodyForAutoload = document.querySelectorAll(parentTarget);

        if (tableBodyForAutoload.length > 0)
        {
            [].forEach.call(tableBodyForAutoload, function(element){
                element.appendChild(trRow);
                rowid++;

                trash.addEventListener('click', function(){
                    element.removeChild(trRow);
                });
            });
        }
    };

    const target = '#autoload-room-rows';
    
    manageFileUpload('myUniqueUploadId');
    autoloadTableRows(target);
    

    // ADD NEW ROW
    var addnewrow = document.querySelector('*[data-target="add-new-rooms"]');
    if (addnewrow !== null)
    {
        addnewrow.addEventListener('click', function(){
            autoloadTableRows(target);
            checkbox(document.querySelector(target));
        });
    }

    // TRIGGER CHECKBOX
    checkbox(document);

    // submit on change
    var submitOnChange = document.querySelectorAll('*[data-target="submit-on-change"]');
    if (submitOnChange.length > 0)
    {
        [].forEach.call(submitOnChange, function(element){
            element.addEventListener('change', function(){
                var url = element.value;
                if (url != '')
                {
                    url = $url + url;
                    window.open(url, '_self', 'location=yes');
                }
            });
        }); 
    }

    // manage navigation pulls
    var getnavigation = document.querySelector('*[data-target="get-navigationid"]');
    if (getnavigation !== null)
    {
        // get navigation body
        var navigationBody = document.querySelector('*[data-target="navigation-body"]');

        getnavigation.addEventListener('change', function(){
            if (this.value == '')
            {
                navigationBody.innerHTML = '';
            }
            else
            {
                // get value
                var getTarget = document.querySelector('*[data-target="navigation-'+this.value+'"]');
                if (getTarget !== null)
                {
                    navigationBody.innerHTML = getTarget.innerHTML;
                }
            }
        });
    }
    
})();
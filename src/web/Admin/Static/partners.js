(function(){
    var modal = document.querySelectorAll('[data-toggle="modal"]');
    [].forEach.call(modal, function(element){
        element.addEventListener('click', function(){
            // get userid
            var userid, row, modalParent, approve, decline;
            userid = element.getAttribute('data-userid');
            row = phpvars.json_data[userid];
            modalParent = document.querySelector(element.getAttribute('data-target'));

            var business = row.business, info = row.info;
            approve = modalParent.querySelector('*[data-target="data-approve"]');
            decline = modalParent.querySelector('*[data-target="data-decline"]');

            for (var column in business)
            {
                var target = modalParent.querySelector('*[data-target="'+column+'"]');

                if (target != null)
                {
                    if (column != 'cac_certificate')
                    {
                        target.innerText = business[column];
                    }
                    else
                    {
                        target.innerHTML = '<a href="?download='+business[column]+'"><span class="fa fa-download"></span> Download Certificate</a>';
                    }
                }
            }

            for (var column in info)
            {
                var target = modalParent.querySelector('*[data-target="'+column+'"]');

                if (target != null)
                {
                    target.innerText = info[column];
                }
            }

            approve.href = approve.href.indexOf('/' + userid) > 0 ? approve.href : approve.href + '/' + userid;
            decline.href = decline.href.indexOf('/' + userid) > 0 ? decline.href : decline.href + '/' + userid;

        });
    });
})(window);
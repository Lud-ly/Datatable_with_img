

//Prog Principal

$(document).ready(function () {
    //Les <select>
    var tags = $('#tags');
    var tags2 = $('#tags2');
    //Datatable
    var tableDT = $('#example').DataTable({
        dom: 'lfrtip',
        responsive:true,
        //sDom: '', // Hiding the datatables ui
        //bLengthChange: false,
        ordering: true,
        columns: [
            {
                "orderable": false
            },
            {
                "orderable": true
            },
            {
                "orderable": true
            },
            {
                "orderable": true
            },
            {
                "orderable": true
            },
            {
                "orderable": true
            },
            {
                "orderable": true
            },
            {
                "orderable": false
            },
            {
                "orderable": false
            }
        ],
        oLanguage: {
            sUrl: "http://cdn.datatables.net/plug-ins/1.10.15/i18n/French.json",
        },
        initComplete: initFilter
    });




    function initFilter() {
        var list = [];
        var list2 = {};
        var tableTag = tableDT.column(3);
        //console.log(tableTag.data());
        // get tags
        tableTag.data().each(function (value, index) {
            var re = /[$,]/;
            if ((re).test(value)) {
                var val = value.split(re); //
                //console.log(val);
                //list.concat(val)
                list.push(val);
            } else {
                list.push(value);
            }
        });
        console.log(list);
        // count tags
        list.forEach(function (x) {
            list2[x] = (list2[x] || 0) + 1;
        });
        var list = []; // set null   
        // push data
        Object.keys(list2).forEach(function (key) {
            list.push({ marque: key, count: list2[key] });
        });
        // sort data
        list.sort(function (a, b) { return (b.count > a.count) ? 1 : ((a.count > b.count) ? -1 : 0); });
        // build le <select>
        $.each(list, function (key, value) {
            var $value = value.marque, $text = value.marque + ' (' + value.count + ')';
            tags.append($("<option></option>").attr("value", $value).text($text));
        });
        // change le <select>
        tags.on('change', function () {
            var val = $.fn.dataTable.util.escapeRegex($(this).val());
            tableTag
                .search(val ? '^' + val + '$' : '', true, false)
                .draw();
        });
        // build <li> dans la nav
        $.each(list, function (key, value) {
            var $value = value.marque, $text = value.marque + ' (' + value.count + ')';
            tags2.append(
                $("<li><a href='#' data-value='" + $value + "'>" + $text + "</a></li>")
            );
        });
        //Onclick Search & find <li>
        tags2.find('a').on('click', function (e) {
            e.preventDefault();
            var val = $.fn.dataTable.util.escapeRegex($(this).attr('data-value'));
            tableTag
                .search(val ? '^' + val + '$' : '', true, false)
                .draw();
        });
        //Table view
        $('#btToggleDisplay').on('click', function () {
            $("#example").toggleClass('cards');
            //$("#example thead, #example tfoot").toggle()
        })
  
    } //initTag
  
});

  window.onscroll = function() {myEffect()};
    
    var navbar = document.getElementById("navbar");
    var sticky = navbar.offsetTop;
    
    function myEffect() {
      if (window.pageYOffset >= sticky) {
        navbar.classList.add("sticky")
      } else {
        navbar.classList.remove("sticky");
      }
    }

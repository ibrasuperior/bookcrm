async function getData(){
    var id = '<?php echo \Auth::user()->id; ?>' ;
    
    var sexto = new Date();
    sexto.setMonth(sexto.getMonth() - 1);

    const dataset  = await fetch('/api/chart-matriculas', { data : id} )
    .then( response => response.json() )
    
    parseInt(dataset)
    
    var options = {
    chart: {
      type: 'line'
    },
    series: [{
      name: 'Matrículas',
      data: [
        dataset['first']
        ]
    }],
    xaxis: {
      categories: [  'jan' ]
    }
  }

    var chart = new ApexCharts(document.querySelector("#chart"), options);

    chart.render();

}


getData()


@extends('admin.layout.index')
@section('content')

<div class="right_col" role="main">
      <!-- top tiles -->
     <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Chart report
                        <small>Users</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                        
                </div>
               <div id="chart"></div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
</div>



@endsection

@section('script')
	
    
    <meta charset="utf-8" />
    <link href="//cdnjs.cloudflare.com/ajax/libs/normalize/3.0.1/normalize.min.css" rel="stylesheet" data-semver="3.0.1" data-require="normalize@*" />
  
  
 
  
<style>
  .legend {
    font-size: 13px;
  }
  h1 {
  font-size: 15px;
  text-align: center;
    }
  rect {
    stroke-width: 2;
  }
  #chart {
  height: 360px;
  margin: 0 auto;                            
  position: relative;
  width: 360px;
    }
  .tooltip {
  box-shadow: 0 0 5px #999999;
  display: none;
  font-size: 12px;
  left: 130px;
  padding: 10px;
  position: absolute;
  text-align: center;
  top: 95px;
  width: 80px;
  z-index: 10;
  line-height: 140%; /*Interlineado*/
  font-family: "Open Sans", sans-serif;
  font-weight: 300;
  background: rgba(0, 0, 0, 0.8);
  color: #fff;
  border-radius: 2px;
    }
  
  .label {
   font-weight: 600;
  }
</style>:
  
  
    
    <script data-require="d3@*" data-semver="4.0.0" src="https://d3js.org/d3.v4.min.js"></script>
    <script>
      (function(d3) {
        'use strict';
        
var tooltip = d3.select('#chart')            
  .append('div')                             
  .attr('class', 'tooltip');                 

tooltip.append('div')                        
  .attr('class', 'label');                   

tooltip.append('div')                        
  .attr('class', 'count');                   

tooltip.append('div')                        
  .attr('class', 'percent');                 

        var dataset = [
          {sala: "Lactantes", value: 74},
            {sala: "Deambuladores", value: 85},
            {sala: "2 años", value: 840},
              {sala: "Primera sección", value: 4579},   
              {sala: "Segunda sección", value: 5472},
              {sala: "Tercera sección", value: 7321},
        ];

        var width = 360;
        var height = 360;
        var radius = Math.min(width, height) / 2;

        var color = d3.scaleOrdinal(d3.schemeCategory20c);

        var svg = d3.select('#chart')
          .append('svg')
          .attr('width', width)
          .attr('height', height)
          .append('g')
          .attr('transform', 'translate(' + (width / 2) + 
            ',' + (height / 2) + ')');
        
        var donutWidth = 75;

        var arc = d3.arc()
          .innerRadius(radius - donutWidth)
          .outerRadius(radius);

        var pie = d3.pie()
          .value(function(d) { return d.value; })
          .sort(null);

        var legendRectSize = 18;
                var legendSpacing = 4;
        
        var path = svg.selectAll('path')
          .data(pie(dataset))
          .enter()
          .append('path')
          .attr('d', arc)
          .attr('fill', function(d, i) { 
            return color(d.data.sala);
          
          });
        
        path.on('mouseover', function(d) {
  var total = d3.sum(dataset.map(function(d) {
    return d.value;
  }));
  var percent = Math.round(1000 * d.data.value / total) / 10;
  tooltip.select('.label').html(d.data.sala);
  tooltip.select('.count').html(d.data.value);
  tooltip.select('.percent').html(percent + '%');
  tooltip.style('display', 'block');
});
        
        path.on('mouseout', function() {
  tooltip.style('display', 'none');
});
          
        var legend = svg.selectAll('.legend')
  .data(color.domain())
  .enter()
  .append('g')
  .attr('class', 'legend')
  .attr('transform', function(d, i) {
    var height = legendRectSize + legendSpacing;
    var offset =  height * color.domain().length / 2;
    var horz = -2 * legendRectSize;
    var vert = i * height - offset;
    return 'translate(' + horz + ',' + vert + ')';
  });
        
        legend.append('rect')
  .attr('width', legendRectSize)
  .attr('height', legendRectSize)
  .style('fill', color)
  .style('stroke', color);
        
        legend.append('text')
  .attr('x', legendRectSize + legendSpacing)
  .attr('y', legendRectSize - legendSpacing)
  .text(function(d) { return d; });

      })(window.d3);
    </script>


@endsection

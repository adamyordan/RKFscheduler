var DivisionRow = React.createClass ({
  render: function() {
    return (
      <a href={'#' + this.props.shortname} className="list-group-item">
        <h4 className="list-group-item-heading">{this.props.shortname}</h4>
        <p className="list-group-item-text">{this.props.name}</p>
      </a>
    );
  }
})

var DivisionList = React.createClass ({
  loadDivisionsFromServer: function() {
    $.ajax({
      url: this.props.url,
      dataType: 'json',
      cache: false,

      success: function(data) {
        this.setState({data: data});
      }.bind(this),

      error: function(xhr, status, err) {
        console.error(this.props.url, status, err.toString());
      }.bind(this)
    });
  },

  getInitialState: function() {
    return {data: []}
  },

  componentDidMount: function() {
    this.loadDivisionsFromServer();
    setInterval(this.loadDivisionsFromServer(), this.props.pollInterval);
  },

  render: function() {

    var divisionNodes = this.state.data.map(function(division) {
      return (
        <DivisionRow key={division.id}
          name={division.name} 
          shortname={division.shortname}
          description={division.description} />
      );
    });

    return (
      <div className="list-group" data-spy="affix">
        {divisionNodes}
      </div>
    );
  }
});

var ProkerRow = React.createClass ({
  render: function() {
    return (
      <tr>
        <td>{this.props.name}</td>
        <td>{this.props.description}</td>
        <td>{this.props.start_date} - {this.props.end_date}</td>
        <td>{this.props.deadline}</td>
        <td>{this.props.done}</td>
      </tr>
    )
  }
});

var ProkerRows = React.createClass ({

  loadFromServer: function() {
    $.ajax({
      url: '/api/division/' + this.props.divisionId + '/proker/',
      dataType: 'json',
      cache: false,

      success: function(data) {
        this.setState({data: data});
      }.bind(this),

      error: function(xhr, status, err) {
        console.error(this.props.url, status, err.toString());
      }.bind(this)
    });
  },

  getInitialState: function() {
    return {data: []};
  },

  componentDidMount: function() {
    this.loadFromServer();
    setInterval(this.loadFromServer(), this.props.pollInterval);
  },

  render: function() {
    var prokerNodes = this.state.data.map(function(proker) {
      return (
        <ProkerRow key={proker.id}
          name={proker.name}
          description={proker.description}
          start_date={proker.start_date}
          end_date={proker.end_date}
          deadline={proker.deadline}
          done={proker.done}
        />
      );
    })
    return (
      <tbody>{prokerNodes}</tbody>
    );
  }

});

var ProkerTable = React.createClass ({
  render: function() {
    return (
      <table className="table">
        <thead>
          <tr>
            <th>Proker</th>
            <th>Deskripsi</th>
            <th>Pelaksaan</th>
            <th>Deadline</th>
            <th>Selesai</th>
          </tr>
        </thead>
        <ProkerRows divisionId={this.props.divisionId} />
      </table>
    );
  }
});

var ProkerSections = React.createClass ({

  loadFromServer: function() {
    $.ajax({
      url: '/api/division/',
      dataType: 'json',
      cache: false,

      success: function(data) {
        this.setState({data: data});
      }.bind(this),

      error: function(xhr, status, err) {
        console.error(this.props.url, status, err.toString());
      }.bind(this)
    });
  },

  getInitialState: function() {
    return {data: []}
  },

  componentDidMount: function() {
    this.loadFromServer();
    setInterval(this.loadFromServer(), this.props.pollInterval);
  },

  render: function() {
    var prokerSections = this.state.data.map(function(division) {
      return (
        <div className="panel panel-default" key={division.id} id={division.shortname}>
          <div className="panel-body">
            <h3> {division.name} </h3>
            <ProkerTable 
              divisionName={division.name}
              divisionId={division.id}
              />
          </div>
        </div>
      );
    })
    return (
      <div>
        {prokerSections}      
      </div>
    );
  }

});


      @foreach($appointmentToMe as $key => $appointment)
      <div>
        <tr >
          <td style=" padding-right: 20px;">{{ $appointment->id }}</td>
          <td style=" padding-right: 20px;">{{ $appointment->client_id }}</td>
          <td style=" padding-right: 20px;">{{ $appointment->appointmentTime }}</td>
          @if($key>0)
          <td style=" padding-right: 20px;">
            <form method="POST" action="/user/updateappointment/{{$user->id}}">
              {{ csrf_field() }}
              <input type="hidden" value="{{$appointment->id}}" name="up"/>
              <button type="submit" >↑</button>
            </form>
          </td>
          @endif
          @if($key<sizeof($appointmentToMe)-1)
          <td style=" padding-right: 20px;">
            <form method="POST" action="/user/updateappointment/{{$user->id}}">
              {{ csrf_field() }}
              <input type="hidden" value="{{$appointment->id}}" name="down"/>
              <button type="submit" >↓</button>
            </form>
          </td>
          @endif
           <td style=" padding-right: 20px;">



            <td style=" padding-right: 20px;">{{ $appointment->id }}</td>
          <td style=" padding-right: 20px;">{{ $appointment->user_id }}</td>
          <td style=" padding-right: 20px;">{{ $appointment->appointmentTime }}</td>
          <td style=" padding-right: 20px;">{{ $appointment->hour }}Hr  {{ $appointment->min }}Min</td>

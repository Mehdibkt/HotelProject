<?php 
    $hname = 'localhost';
    $uname = 'root';
    $pass = '';
    $db = 'groupe8hotel';
    $con = mysqli_connect($hname,$uname, $pass, $db);

    if(!$con){
        die("Cannot connect to database.".mysqli_connect_error());
    }


    function selectAll($table)
    { $con = $GLOBALS['con'];
      $res = mysqli_query($con,"SELECT * FROM $table");
      return $res; }

    function select($sql,$values,$datatypes){
        $con = $GLOBALS['con'];
        if($stmt = mysqli_prepare($con,$sql)){
        mysqli_stmt_bind_param($stmt,$datatypes,...$values);
            if(mysqli_stmt_execute($stmt)){
                $res = mysqli_stmt_get_result($stmt);
                mysqli_stmt_close($stmt);
                return $res;
            }
        else{
            mysqli_stmt_close($stmt);
            die("Query cannot be executed - Select");
        }
        }
        else{
        die("Query cannot be prepared - Select");
        }
    }

    function update($sql,$values,$datatypes)
  {
    $con = $GLOBALS['con'];
    if($stmt = mysqli_prepare($con,$sql))
    {
      mysqli_stmt_bind_param($stmt,$datatypes,...$values);
      if(mysqli_stmt_execute($stmt)){
        $res = mysqli_stmt_affected_rows($stmt);
        mysqli_stmt_close($stmt);
        return $res;
      }
      else{
        mysqli_stmt_close($stmt);
        die("Query cannot be executed - Update");
      }
    }
    else{
      die("Query cannot be prepared - Update");
    }
  }

  function insert($sql,$values,$datatypes)
  {
    $con = $GLOBALS['con'];
    if($stmt = mysqli_prepare($con,$sql))
    {
      mysqli_stmt_bind_param($stmt,$datatypes,...$values);
      if(mysqli_stmt_execute($stmt)){
        $res = mysqli_stmt_affected_rows($stmt);
        mysqli_stmt_close($stmt);
        return $res;
      }
      else{
        mysqli_stmt_close($stmt);
        die("Query cannot be executed - Insert");
      }
    }
    else{
      die("Query cannot be prepared - Insert");
    }
  }

  function delete($sql,$values,$datatypes)
  {
    $con = $GLOBALS['con'];
    if($stmt = mysqli_prepare($con,$sql))
    {
      mysqli_stmt_bind_param($stmt,$datatypes,...$values);
      if(mysqli_stmt_execute($stmt)){
        $res = mysqli_stmt_affected_rows($stmt);
        mysqli_stmt_close($stmt);
        return $res;
      }
      else{
        mysqli_stmt_close($stmt);
        die("Query cannot be executed - Delete");
      }
    }
    else{
      die("Query cannot be prepared - Delete");
    }
  }
  function updateTotalRoomsForHotel($hotel_id)
{
    $con = $GLOBALS['con'];
    $query = "SELECT SUM(rooms.quantity) as total_rooms
              FROM rooms INNER JOIN hotels ON hotels.hotel_id = rooms.hotel_id
              WHERE hotels.hotel_id = ? GROUP BY hotels.hotel_id";

    if ($stmt = mysqli_prepare($con, $query)) {
        mysqli_stmt_bind_param($stmt, "i", $hotel_id);
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_bind_result($stmt, $total_rooms);
            mysqli_stmt_fetch($stmt);
            mysqli_stmt_close($stmt);
        } else {
            mysqli_stmt_close($stmt);
            die("Query cannot be executed - Select");
        }
    } else {
        die("Query cannot be prepared - Select");
    }

    $query = "UPDATE hotels SET nb_rooms = ? WHERE hotel_id = ?";
    if ($stmt = mysqli_prepare($con, $query)) {
        mysqli_stmt_bind_param($stmt, "ii", $total_rooms, $hotel_id);
        if (mysqli_stmt_execute($stmt)) {
            $res = mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt);
            return $res;
        } else {
            mysqli_stmt_close($stmt);
            die("Query cannot be executed - Update");
        }
    } else {
        die("Query cannot be prepared - Update");
    }
}
function updateTotalRooms($original_hotel_id, $new_hotel_id) {
  // Update the total rooms for the original hotel
  updateTotalRoomsForHotel($original_hotel_id);

  // If the new hotel is different from the original hotel, update its total rooms as well
  if ($original_hotel_id !== $new_hotel_id) {
    updateTotalRoomsForHotel($new_hotel_id);
  }
}
  
  function updateTotalHotelsForChains($chain_id)
{
    $con = $GLOBALS['con'];
    $query = "SELECT COUNT(*) as total_hotels
              FROM hotels
              WHERE hotels.chain_id=?";

    if ($stmt = mysqli_prepare($con, $query)) {
        mysqli_stmt_bind_param($stmt, "i", $chain_id);
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_bind_result($stmt, $total_hotels);
            mysqli_stmt_fetch($stmt);
            mysqli_stmt_close($stmt);
        } else {
            mysqli_stmt_close($stmt);
            die("Query cannot be executed - Select");
        }
    } else {
        die("Query cannot be prepared - Select");
    }

    $query = "UPDATE chains SET nb_hotels = ? WHERE chain_id = ?";
    if ($stmt = mysqli_prepare($con, $query)) {
        mysqli_stmt_bind_param($stmt, "ii", $total_hotels, $chain_id);
        if (mysqli_stmt_execute($stmt)) {
            $res = mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt);
            return $res;
        } else {
            mysqli_stmt_close($stmt);
            die("Query cannot be executed - Update");
        }
    } else {
        die("Query cannot be prepared - Update");
    }
}
function updateTotalHotels($original_chain_id, $new_chain_id) {
  // Update the total hotels for the original chain
  updateTotalHotelsForChains($original_chain_id);

  // If the new chain is different from the original chain, update its total hotels as well
  if ($original_chain_id !== $new_chain_id) {
    updateTotalHotelsForChains($new_chain_id);
  }
}
  

?>
<?php echo $header; ?>
<div class="container">
    <div id="animals-module">
        <?php if (isset($users_animals) ) { ?>
            <ul class="pet-list" id="ul-pet-list">
                <?php foreach ($users_animals as $animal) { ?>
                    <li id="user-animal-<?php echo $animal['id']; ?>">
                        <?php echo $animal['animal']; ?> <?php echo $animal['breed']; ?> <?php echo $animal['age']; ?> мес.
                        <button class="btn-delete-pet" data-id="<?php echo $animal['id']; ?>">x</button>
                    </li>
                <?php } ?>
            </ul>
        <?php } ?>
        
        <form id="add-pet-form" action="<?php echo $action; ?>" method="post">
            <label for="pet-type">Питомець:</label>
            <select id="pet-type" name="pet_type">
                <option value="">Виберіть питомця</option>
                <?php foreach ($animals as $animal) { 
                    echo "<option value='". $animal['id'] . "'>". $animal['name'] . "</option>";
                }?>
            </select><br>
            
            <label for="breed">Порода:</label>
            <select id="breed" name="breed">
                <option value="">Виберіть породу</option>
            </select><br>
            
            <label for="gender">Стать:</label>
            <select id="gender" name="gender">
                <option value="">Виберіть стать</option>
            </select><br>
            
            <label for="age">Вік в місяцях:</label>
            <input type="number" id="age" name="age" value="1" min="1"><br>
            
            <button type="submit" id="add-pet-button">Додати питомця</button>
        </form>
    </div>
</div>
<?php echo $footer; ?>
<script>
$(document).ready(function() {
    // Завантаження порід та статей при зміні типу питомця
    $('#pet-type').on('change', function() {
        var petType = $(this).val();
        var breeds = <?php echo json_encode($breeds); ?>;
        $('#breed').empty();
        $('#gender').empty();
        var sex = '';
        breeds.forEach(function(breed) {
             
            if(petType==breed.animal_id){
                $('#breed').append('<option value="' + breed.id + '">' + breed.breed + '</option>');
                sex = breed.sex;
            }
        })
        if(sex=='1'){
            $('#gender').append('<option value="man">мужской</option><option value="woman">Женский</option>');
        }else{
            $('#gender').append('<option value="no">немає пола</option>');
        }
    });
    
    // Додавання питомця
    $('#add-pet-form').on('submit', function(e) {
        e.preventDefault();
       var animal = $("#pet-type").val();
       var breed = $("#breed").val();
       var age = $("#age").val();
       var breedText = $("#breed option:selected").text();
       var animalText = $("#pet-type option:selected").text();
    if(animal!=='' && breed!=='' && age!==''){
        var formData = $(this).serialize();
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData,
            success: function(response) {
                $('#ul-pet-list').append("<li id='user-animal-"+response+"'>"+animalText+" "+breedText+" "+age+" мес.<button class='btn-delete-pet' data-id='"+response+"'>x</button></li>")
                // Додавання питомця до списку
                $("#pet-type").val('');
                $("#breed").val('');
                $("#age").val('1');
                $('#gender').empty();
            }
        });
    }else{
        if(animal==''){
            $("#pet-type").css({'border':'2px solid #a94442'});
        } 
        if(breed==''){
            $("#breed").css({'border':'2px solid #a94442'});
        }
        if(age==''){
            $("#age").css({'border':'2px solid #a94442'});
        }
    }
    });
    
    // Видалення питомця
    $('.btn-delete-pet').on('click', function() {
        var userAnimalId = $(this).data('id');
        if (confirm('Ви впевнені, що хочете видалити цього питомця?')) {
            $.ajax({
                url: '<?php echo $delete; ?>',
                type: 'POST',
                data: { delete_user_animal_id: userAnimalId },
                success: function(response) {
                    // Видалення питомця зі списку
                    $("#user-animal-"+userAnimalId).remove();
                }
            });
        }
    });
});
</script>
<meta name="csrf-token" content="{{ csrf_token() }}">
<script src="https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js">
</script>
<script>

    /*$.ajax({
      /!*headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},*!/
      url:"{{route('api.check.test.show',array('id'=>566))}}",
      data:{photos:'hahah'},
      dataType:'JSON',
      method:'GET',
      success:function(res){
          console.log(res)
        }
    });*/
</script>
<script src="/static/encrypt/jsencrypt.min.js">

</script>
<script>

    var encrypt = new JSEncrypt();
    encrypt.setPublicKey("-----BEGIN PUBLIC KEY-----\n" +
        "MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQC8mXUgJWo0E9/Q+lv3dm5fsGow\n" +
        "7WyHEQvJF3RnLbudrDQOCgfVPMvl/LoJmOMmlfu2mIas3k4AxGW9C0KNPpcEl9KP\n" +
        "yxJP/p3H4e00/3I/6xm6zWBWoMcbmVo7AkzTN1qhOQ1O15dEUb7KhgYbFoFVxPV0\n" +
        "8hMhy3NtPnkEAE44OQIDAQAB\n" +
        "-----END PUBLIC KEY-----");

    /*encrypt.setPrivateKey("-----BEGIN RSA PRIVATE KEY-----\n" +
        "MIICXQIBAAKBgQC8mXUgJWo0E9/Q+lv3dm5fsGow7WyHEQvJF3RnLbudrDQOCgfV\n" +
        "PMvl/LoJmOMmlfu2mIas3k4AxGW9C0KNPpcEl9KPyxJP/p3H4e00/3I/6xm6zWBW\n" +
        "oMcbmVo7AkzTN1qhOQ1O15dEUb7KhgYbFoFVxPV08hMhy3NtPnkEAE44OQIDAQAB\n" +
        "AoGAbcKtnKjJt0c9wcSC03E0aTIlixYSTEUKY9znnMjL4MaAgQ8rYdmBHPdJWh6F\n" +
        "TEaLeMgp0N+L6/xg7XVpJQShJEQrKLHLZKWSQ6CpDrcYNmLpepdRcc7YYfXE7Npk\n" +
        "bQ4AkXsO2XwhCaMA3B5KRjzggmMDVl4BANvdYHNzBAmIfKUCQQD6z6Oh4T3L3YVN\n" +
        "6uHioGujSqkoqvnXVxt+/6CF6WozT6NM3KaJBX6ZPyrljSONWoCZJ9rbApufKPdW\n" +
        "F6CaPWgHAkEAwIBUSktb2TwImCAoHWko+Ixqf1RVdlKCa8AXKipLm6C7YgryNlKI\n" +
        "tzMlnAo+R08tJ4XUIDy+R2s/C6e9UlDNvwJBAOVKsmOp0Z7w04+aLgvLcNwFw4QE\n" +
        "Wwg9AEwoUo5aB9cE9VutVSprNYPQNd1KHLh7hpl90Bzs02y8PPIeA5s+jD0CQQCI\n" +
        "TtZgvTfOfQoA3lRJbxtJ0/PdMZRKcmZTcfN1MfnTu160L9gOyyZvwtHQyhgLWm84\n" +
        "2zS3lwuNes1rrV0Lmpf1AkAJkR8nrkOSISwZw4KW9yA7oXkZaSkcMhwNRcVaFSYE\n" +
        "ouMYAnUfarjENc9kWxwaveIjfMbA9kjlLwwch7UO4WMs\n" +
        "-----END RSA PRIVATE KEY-----");
    var uncrypted = encrypt.encrypt("3242");*/
    var a = encrypt.decrypt(Base64.decode("AEOO7hXTw+egwhtrbEGQtHwXbFsbLH60uYe04QJhJ5lCFms6urQDR0JLzt74eXnKlcA094ilNIwWumV7iTKbNCgMP67m5F30O8zRnxFtfkjJkdqV9lEyFMkU0OC+I91G7nicGvXf+TIfdCDUxG/ygR60SX7oPMgAn0SU1D6PgRE="));

    console.log(a)
</script>

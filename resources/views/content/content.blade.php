@extends('layout')
@section('title', 'Page Title')
@section('content')

<template v-if="menu==0">
    <h1>Escritorio</h1>
</template>

<template v-if="menu==1">
    <categoria></categoria>
</template>
<template v-if="menu==2">
    <producto></producto>
</template>
<template v-if="menu==3">
    <compra></compra>
</template>
<template v-if="menu==4">
    <proveedor></proveedor>
</template>
<template v-if="menu==5">
    <h1>Ventas</h1>
</template>
<template v-if="menu==6">
    <cliente></cliente>
</template>
<template v-if="menu==7">
    <user></user>
</template>
<template v-if="menu==8">
    <role></role>
</template>

@endsection
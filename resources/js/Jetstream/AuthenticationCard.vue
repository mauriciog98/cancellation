<template>
    <div class="relative flex min-h-screen flex-col justify-center overflow-hidden bg-gray-50">
        <div class="absolute inset-0 bg-orange-500 bg-center"></div>
        <div
            class="px-z relative left-0 top-0 h-screen w-full max-w-lg rounded-r-[4rem] bg-white pt-10 pb-8 sm:max-w-2xl sm:pr-10 lg:rounded-r-[6rem]">
            <div class="text mx-auto max-w-sm">
                <div class="text-center">
                    <slot name="logo"/>
                </div>
                <div class="divide-y divide-gray-300/50">
                    <div class="space-y-6 py-8 leading-7">

                                <slot/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

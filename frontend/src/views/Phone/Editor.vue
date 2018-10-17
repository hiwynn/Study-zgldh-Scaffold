<template>
    <el-row class="phone-editor-page" v-loading="loading">
        <el-col :span="11">
            <editor-title :name="$t('phone.title')"></editor-title>

            <el-form label-position="right" label-width="80px" :rules="rules" :model="form"
                     ref="form">

                <form-item :label="$t('global.fields.id')" v-if="form.id">
                    <el-input v-model="form.id" disabled></el-input>
                </form-item>
                <form-item :label="$t('phone.fields.title')" prop="title">
                    <el-input v-model="form.title"></el-input>
                </form-item>
                <form-item :label="$t('phone.fields.description')" prop="description">
                    <el-input v-model="form.description"></el-input>
                </form-item>
                <form-item :label="$t('phone.fields.phone_number')" prop="phone_number">
                    <el-input v-model="form.phone_number"></el-input>
                </form-item>
                <!--<form-item :label="$t('phone.fields.status')" prop="status">
                    <el-input v-model="form.status"></el-input>
                    <el-select
                            v-model="form.status"
                            value-key=""
                            multiple
                            filterable
                            reserve-keyword
                            placeholder="请选择状态">
                        <el-option
                                v-for="item in status_options"
                                :key="item.name"
                                :label="item.name"
                                :value="item.value">
                        </el-option>
                    </el-select>
                </form-item>-->
                <form-item :label="$t('global.fields.created_at')" v-if="form.id">
                    <el-input v-model="form.created_at" disabled></el-input>
                </form-item>

                <form-item>
                    <el-button type="primary" @click="isCreating?onCreate():onUpdate()">
                        {{$t('global.terms.submit')}}
                    </el-button>
                    <el-button @click="$router.go(-1)">{{$t('global.terms.back')}}</el-button>
                </form-item>
            </el-form>
        </el-col>
        <el-col :span="11" :offset="1"></el-col>
    </el-row>
</template>

<script type="javascript">
    import store from '@/store'
    import {mapState} from 'vuex'
    import {SuccessMessage} from '@/utils/message'
    import {phoneStore, phoneUpdate, phoneShow} from '@/api/phone'
    import EditorMixin from '@/mixins/Editor'

    export default {
        components: {},
        mixins    : [EditorMixin],
        data() {
            return {
                rules: {},
                form : {
                    "title"       : null,
                    "description" : null,
                    "phone_number": null,
                    "status"      : 1,
                    "find_counts" : 0,
                    "added_by"    : null,
                    "updated_by"  : null
                },
            };
        },
        computed  : {
            // ...mapState({
            //     status_options: state => state.status_options
            // })
        },
//    beforeRouteEnter(to, from, next){
//      Preload store data here.
//      store.dispatch('user/LoadRoles').then(next);
//    },
        mounted() {
            // this.status_options= [{name: 'show', value: '1'}, {name: 'hide', value: '0'}]
            this.fetchData();
        },
        watch     : {
            $route: 'fetchData',
        },
        mounted   : function () {
            this.loading = true;
            let loads = [];
            if (this.$route.params.id) {
                this.form.id = this.$route.params.id;
                loads.push(axios.get(this.resource));
            }

            Promise.all(loads).then(results => {
                this.form = results[0].data.data;
                this.loading = false;
            }).catch(err => {
                this.loading = false;
            });
        },
        methods   : {
            fetchData() {
                if (this.$route.params.id) {
                    this.loading = true;
                    phoneShow(this.$route.params.id, '_with=roles')
                        .then(res => this.setFormData(res.data))
                        .then(res => this.loading = false)
                }
            },
            setFormData(rawFormData) {
                this.form = rawFormData
            },
            onCreate() {
                this.$refs.form.validate().then(valid => {
                    this.loading = true;
                    return PhoneStore('_with=roles', this.form);
                })
                    .then(SuccessMessage(this.$t('global.terms.save_completed')))
                    .then(res => {
                        this.loading = false;
                        this.$router.replace({path: `/phone/${this.data.id}/edit`});
                    })
                    .catch(this.errorHandler);
            },
            onUpdate() {
                this.$refs.form.validate().then(valid => {
                    this.loading = true;
                    return PhoneUpdate(this.form.id, '_with=roles', this.form)
                })
                    .then(res => this.setFormData(res.data))
                    .then(SuccessMessage(this.$t('global.terms.save_completed')))
                    .then(res => this.loading = false)
                    .catch(this.errorHandler);
            }
        }
    };
</script>

<style rel="stylesheet/scss" lang="scss">
    .phone-editor-page {
        margin: 10px 30px;
    }
</style>

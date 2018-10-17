<template>
    <el-row class="phone-list-page list-page">
        <el-col :span="24">
            <list-title :name="$t('phone.title')"></list-title>

            <zgldh-datatables ref="table"
                              :source="loadData"
                              :actions="actions"
                              :multiple-actions="multipleActions"
                              :filters="advanceFilters">
                <el-table-column
                        prop="title"
                        :label="$t('phone.fields.title')"
                        sortable="custom"
                        searchable="true"
                        show-overflow-tooltip>
                </el-table-column>

                <el-table-column
                        prop="phone_number"
                        :label="$t('phone.fields.phone_number')"
                        sortable="custom"
                        searchable="true"
                        show-overflow-tooltip>
                </el-table-column>

                <el-table-column
                        prop="description"
                        :label="$t('phone.fields.description')"
                        sortable="custom"
                        searchable="true"
                        show-overflow-tooltip>
                </el-table-column>

                <el-table-column
                        prop="status"
                        :label="$t('phone.fields.status')"
                        sortable="custom"
                        searchable="true"
                        show-overflow-tooltip>
                </el-table-column>

                <el-table-column
                        prop="find_counts"
                        :label="$t('phone.fields.find_counts')"
                        sortable="custom"
                        searchable="true"
                        show-overflow-tooltip>
                </el-table-column>

                <el-table-column
                        prop="added_by"
                        :label="$t('phone.fields.added_by')"
                        sortable="custom"
                        searchable="true"
                        show-overflow-tooltip>
                    <template slot-scope="scope">
                        <span>{{scope.row.user?scope.row.user.name:''                                    }}</span>
                    </template>
                </el-table-column>

                <el-table-column
                        prop="updated_by"
                        :label="$t('phone.fields.updated_by')"
                        sortable="custom"
                        searchable="true"
                        show-overflow-tooltip>
                    <template slot-scope="scope">
                        <span>{{scope.row.user?scope.row.user.name:''                                    }}</span>
                    </template>
                </el-table-column>

            </zgldh-datatables>
        </el-col>
    </el-row>
</template>

<script type="javascript">
    import {DeleteConfirm} from '@/utils/message'
    import {phoneIndex, phoneDestroy} from '@/api/phone'
    import ListMixin from '@/mixins/List'

    export default {
        components: {},
        mixins    : [ListMixin],
        computed  : {
            _addedByList() {
                return this.$store.state.phone._addedByList;
            },
            _updatedByList() {
                return this.$store.state.phone._updatedByList;
            },
        },
        data() {
            let data = {
                actions        : [
                    {
                        Title : () => this.$i18n.t('global.terms.edit'),
                        Handle: this.handleEdit
                    },
                    {
                        Title : () => this.$i18n.t('global.terms.delete'),
                        Handle: this.handleDelete
                    },
                    {
                        Title : () => this.$i18n.t('global.terms.yes'),
                        More  : true,
                        Handle: this.handleYes
                    },
                    {
                        Title : () => this.$i18n.t('global.terms.skip'),
                        More  : true,
                        Handle: this.handleSkip
                    },
                ],
                multipleActions: [
                    {
                        Title : () => this.$i18n.t('global.terms.create'),
                        Handle: this.handleCreate
                    },
                    {
                        Title     : () => this.$i18n.t('global.terms.confirm'),
                        More      : true,
                        TargetCare: true,
                        Handle    : this.handleConfirm
                    },
                ],
                advanceFilters : [
                    {
                        Name : () => this.$i18n.t('phone.fields.description'),
                        Field: 'description',
                        Type : String
                    },
                    {
                        Name : () => this.$i18n.t('phone.fields.status'),
                        Field: 'status',
                        Type : String
                    },
                    {
                        Name : () => this.$i18n.t('phone.fields.find_counts'),
                        Field: 'find_counts',
                        Type : String
                    },
                    {
                        Name : () => this.$i18n.t('phone.fields.added_by'),
                        Field: 'added_by',
                        Type : String
                    },
                    {
                        Name : () => this.$i18n.t('phone.fields.updated_by'),
                        Field: 'updated_by',
                        Type : String
                    },
                ]
            };
            return data;
        },
        mounted() {
        },
        methods   : {
            loadData: (parameters) => {
                var _with = 'user,comments';
                parameters += _with;
                return phoneIndex(parameters);
            },
            handleCreate(items) {
                this.$router.push({path: `/phone/create`})
            },
            handleEdit(item) {
                this.$router.push({path: `/phone/${item.id}/edit`})
            },
            handleDelete(item) {
                DeleteConfirm(item.name, () => phoneDestroy(item.id)).then(() => this.$refs.table.removeItem(item))
            },
            handleYes(item) {
                console.log('yes', item);
            },
            handleSkip(item) {
                console.log('skip', item);
            },
            handleConfirm(items) {
                console.log('confirm', items);
            }
        }
    }
</script>

<style rel="stylesheet/scss" lang="scss">
    .phone-list-page {
        margin: 10px 30px;
        .el-table__body-wrapper {
            height: calc(100vh - 310px) !important;
        }
    }
</style>

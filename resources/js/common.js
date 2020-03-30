const churchRecord = {

}
const churchRecordPlugin = {
    install(Vue) {
      Vue.mixin({
        methods: {
            getPermissions(roles) {
                let permissionsToDisp = '';
                for (var i = 0; i < roles.length; i++) {
                    for (var j = 0; j < roles[i].permissions.length; j++) {
                        permissionsToDisp += roles[i].permissions[j].name;
                        if (j !== roles[i].permissions.length - 1) {
                            permissionsToDisp += ', ';
                        }
                    }
                }
                return permissionsToDisp;
            },
            getRoles(roles) {
                let rolesToDisp = '';
                for (var i = 0; i < roles.length; i++) {
                    rolesToDisp += roles[i].name;
                    if (i !== roles.length - 1) {
                       rolesToDisp += ', ';
                    }
                }
                return rolesToDisp;
            },
            permissions(auth){
                let permissions = [];
                let roles = auth.roles;
                if (roles) {
                    roles.forEach(role => {
                        if (role.permissions) {
                            role.permissions.forEach(permission => {
                                permissions.push(permission);
                            });
                        }
                    });
                }
               return permissions;
            },
        },
      });

      Object.defineProperty(Vue.prototype, "$churchRecord", {
        get() {
          return this.$root;
        }
      });
    }
  };
export default churchRecordPlugin;
